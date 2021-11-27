<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    public function test_successful_login()
    {
        $name = 'Sample Account';
        $email = 'sample@sample.com';
        $password = 'password';

        $user = User::query()
            ->firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ]
            );

        if ($user) {
            $loginData = [
                'email' => $user->email,
                'password' => $password,
            ];

            $this->json('POST', 'api/auth/login', $loginData, ['Accept' => 'application/json'])
                ->assertStatus(200)
                ->assertJsonStructure([
                    "access_token",
                    "token_type",
                    "expires_in"
                ]);

            $this->assertAuthenticated();
        }
    }

    public function test_invalid_credentials()
    {
        $loginData = [
            'email' => 'invalid@email.com',
            'password' => 'invalid'
        ];

        $this->json('POST', 'api/auth/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJsonStructure([
                "error",
            ]);
    }
}
