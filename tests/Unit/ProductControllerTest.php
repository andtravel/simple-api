<?php

namespace Tests\Unit;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_products(): void
    {
        $products = Product::factory(3)->create();
        $categories = Category::factory(3)->create();
        $products->each(function ($product) use ($categories) {
            $product->categories()->attach($categories);
        });

        $response = $this->getJson(route('products.index'));

        $response->assertOk()
        ->assertJsonStructure([
            '*' =>[
                'id',
                'name',
                'description',
                'price',
                'quantity',
                'categories'
            ]
        ]);

        $this->assertCount(3, $response->json());

        $products->each(function ($product) use ($response) {
            $response->assertJsonFragment([
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'categories' => CategoryResource::collection($product->categories)
                    ->pluck('id')
                    ->map(fn ($id) => ['id' => $id, 'name' => $product->categories->where('id', $id)->first()->name]),
             ]);
        });
    }

    public function test_user_can_see_product()
    {
        $product = Product::factory()->create();

        $categories = Category::factory(3)->create();
        $product->categories()->attach($categories);

        $response = $this->getJson(route('products.show', $product));

        $response->assertOk()
            ->assertJsonStructure([
                '*' =>[
                    'id',
                    'name',
                    'description',
                    'price',
                    'quantity',
                    'categories'
                ]
            ]);

            $response->assertJsonFragment([
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'categories' => CategoryResource::collection($product->categories)
                    ->pluck('id')
                    ->map(fn ($id) => ['id' => $id, 'name' => $product->categories->where('id', $id)->first()->name]),
            ]);
    }

    public function test_auth_user_can_create_product()
    {
        $this->authorization();
        $categories = Category::factory(3)->create();
        $response = $this->postJson(route('products.store', [
            'name' => 'Test product',
            'description' => 'Test description',
            'price' => 100,
            'quantity' => 10,
            'categories' => $categories->pluck('id')->toArray()
        ]));

        $response->assertCreated()
                ->assertJsonStructure([
                        'id',
                        'name',
                        'description',
                        'price',
                        'quantity',
                        'categories'
                ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test product',
            'description' => 'Test description',
            'price' => 100,
            'quantity' => 10,
        ]);
    }

    public function test_unauthenticated_user_cannot_create_product()
    {
        $response = $this->postJson(route('products.store', [
            'name' => 'Test product',
            'description' => 'Test description',
            'price' => 100,
            'quantity' => 10
        ]));

        $this->assertDatabaseMissing('products', [
            'name' => 'Test product',
            'description' => 'Test description',
            'price' => 100,
            'quantity' => 10
        ]);

        $response->assertUnauthorized();
    }

    public function test_auth_user_can_update_product()
    {
        $this->authorization();
        $product = Product::factory()->create();
        $categories = Category::factory(3)->create();
        $response = $this->putJson(route('products.update', $product), [
            'name' => 'Test product updated',
            'description' => 'Test description',
            'price' => 100,
            'quantity' => 10,
            'categories' => $categories->pluck('id')->toArray()
        ]);

        $response->assertOk()
                ->assertJsonStructure([
                        'id',
                        'name',
                        'description',
                        'price',
                        'quantity',
                        'categories'
                ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test product updated',
            'description' => 'Test description',
            'price' => 100,
            'quantity' => 10,
        ]);
    }

    public function test_unauthenticated_user_cannot_update_product()
    {
        $product = Product::factory()->create();
        $response = $this->putJson(route('products.update', $product), [
            'name' => 'Test product updated',
            'description' => 'Test description',
            'price' => 100,
            'quantity' => 10
        ]);

        $this->assertDatabaseHas('products', [
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => $product->quantity
        ]);

        $response->assertUnauthorized();
    }

    public function test_auth_user_can_delete_product()
    {
        $this->authorization();
        $product = Product::factory()->create();
        $categories = Category::factory(3)->create();
        $product->categories()->saveMany($categories);

        $response = $this->deleteJson(route('products.destroy', $product));

        $response->assertNoContent();

        $this->assertDatabaseMissing('products', [
            'name' => $product->name,
        ]);

        $this->assertDatabaseMissing('category_product', [
            'product_id' => $product->id,
            'category_id' => $categories->pluck('id')->first(),
        ]);
    }

    public function test_unauthenticated_user_cannot_delete_product()
    {
        $product = Product::factory()->create();
        $response = $this->deleteJson(route('products.destroy', $product));

        $this->assertDatabaseHas('products', [
            'name' => $product->name,
        ]);

        $response->assertUnauthorized();
    }
}
