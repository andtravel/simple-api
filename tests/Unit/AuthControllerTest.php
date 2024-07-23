<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register(): void
    {
        $response = $this->postJson('/api/v1/register',[
            'name' => 'John Doe',
            'email' => 'johndoe@me.com',
            'password' => Hash::make('password'),
        ]);

        $response->assertCreated()
            ->assertJsonStructure([
                'data' => ['id', 'name', 'email'],
                'access_token',
                'token_type'
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'johndoe@me.com',
        ]);

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => 1,
        ]);
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
                'password' => Hash::make('password')
            ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

            $response->assertOk()
            ->assertJsonStructure([
                'data' => ['id', 'name', 'email'],
                'access_token',
                'token_type'
            ]);
    }

    public function test_auth_user_can_logout(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $this->postJson('/api/v1/logout', [], [
            'Authorization' => "Bearer $token"
        ])->assertOk();

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id
        ]);
    }

    public function test_auth_user_can_see_profile(): void
    {
        $this->authorization();

        $this->getJson('/api/v1/user')
            ->assertOk()
            ->assertJsonStructure([
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
             ]);
    }

    public function test_unauthenticated_user_cannot_see_profile()
    {
        $response = $this->getJson('/api/v1/user');

        $response->assertUnauthorized();
    }
}
