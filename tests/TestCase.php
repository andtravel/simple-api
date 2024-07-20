<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function authorization(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('Test token')->plainTextToken;
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ]);
    }
}
