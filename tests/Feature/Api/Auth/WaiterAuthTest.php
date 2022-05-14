<?php

namespace Tests\Feature\Api\Auth;

use App\Models\Waiter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class WaiterAuthTest extends TestCase
{
    use UtilsTrait;

    public function test_fail_auth()
    {
        $response = $this->postJson('/login-waiter', []);

        $response->assertStatus(422);
    }

    public function test_auth()
    {
        $waiter = Waiter::factory()->create();

        $response = $this->postJson('/login-waiter', [
            'login' => $waiter->login,
            'password' => '1918',
            'device_name' => 'test'
        ]); 

        $response->assertStatus(200);
    }

    public function test_error_logout()
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }

    public function test_logout()
    {
        $token = $this->createTokenWaiter();

        $response = $this->postJson('/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200);
    }

    public function test_error_get_me()
    {
        $response = $this->getJson('/me');

        $response->assertStatus(401);
    }

    public function test_get_me()
    {
        $token = $this->createTokenWaiter();

        $response = $this->getJson('/me', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200);
    }

}
