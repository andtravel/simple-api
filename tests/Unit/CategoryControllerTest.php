<?php

namespace Tests\Unit;

use AllowDynamicProperties;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_categories(): void
    {
        $categories = Category::factory(3)->create();
        $products = Product::factory(3)->create();

        $categories->each(function ($category) use ($products) {
            $category->products()->saveMany($products);
        });

        $response = $this->getJson(route('categories.index'));

        $response->assertOk()
        ->assertJsonStructure([
            '*' =>[
                'id',
                'name',
                'products'
            ]
        ]);

        $this->assertCount(3, $response->json());

        $categories->each(function ($category) use ($response) {
            $response->assertJsonFragment([
                'id' => $category->id,
                'name' => $category->name,
                'products' => ProductResource::collection($category->products)->resolve(),
            ]);
        });
    }

    public function test_user_can_see_category()
    {
        $category = Category::factory()->create();
        $products = Product::factory(3)->create();
        $category->products()->saveMany($products);

        $response = $this->getJson(route('categories.show', $category));

        $response->assertOk()
        ->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'products'
            ]
        ]);

        $response->assertJsonFragment([
            'id' => $category->id,
            'name' => $category->name,
            'products' => ProductResource::collection($category->products)->resolve(),
        ]);
    }

    public function test_auth_user_can_create_category()
    {
        $this->authorization();
        $response = $this->postJson(route('categories.store'), [
            'name' => 'Test category',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test category',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'products'
                ]
            ]);

        $response->assertJsonFragment([
            'name' => 'Test category',
        ]);

    }

    public function test_unuathenticated_user_cannot_create_category()
    {
        $response = $this->postJson(route('categories.store'), [
            'name' => 'Test category',
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => 'Test category',
        ]);

        $response->assertUnauthorized();
    }

    public function test_auth_user_can_update_category()
    {
        $this->authorization();
        $category = Category::factory()->create();

        $response = $this->putJson(route('categories.update', $category), [
            'name' => 'Updated category',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Updated category',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'products'
                ]
            ]);

        $response->assertJsonFragment([
            'name' => 'Updated category',
        ]);
    }

    public function test_unuathenticated_user_cannot_update_category()
    {
        $category = Category::factory()->create();
        $response = $this->putJson(route('categories.update', $category), [
            'name' => 'Updated category',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => $category->name,
        ]);

        $response->assertUnauthorized();
    }

    public function test_auth_user_can_delete_category()
    {
        $this->authorization();
        $category = Category::factory()->create();
        $products = Product::factory(3)->create();
        $category->products()->saveMany($products);

        $response = $this->deleteJson(route('categories.destroy', $category));

        $this->assertDatabaseMissing('categories', [
            'name' => $category->name,
        ]);

        $this->assertDatabaseMissing('category_product', [
            'category_id' => $category->id,
            'product_id' => $products->pluck('id')->first(),
        ]);

        $response->assertStatus(204);
    }

    public function test_unauthenticated_user_cannot_delete_category()
    {
        $category = Category::factory()->create();
        $response = $this->deleteJson(route('categories.destroy', $category));

        $this->assertDatabaseHas('categories', [
            'name' => $category->name,
        ]);

        $response->assertUnauthorized();
    }

    public function test_user_can_see_category_products()
    {
        $category = Category::factory()->create();
        $products = Product::factory(3)->create();
        $category->products()->saveMany($products);

        $response = $this->getJson(route('categories.products', $category));

        $response->assertOk();
        $this->assertNotEmpty($response->json());
    }
}
