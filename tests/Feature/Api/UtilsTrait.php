<?php

namespace Tests\Feature\Api;

use App\Models\Waiter;

trait UtilsTrait
{
    public function createWaiter()
    {
        $waiter = Waiter::factory()->create();

        return $waiter;
    }

    public function createTokenWaiter()
    {
        $waiter = $this->createWaiter();

        $token = $waiter->createToken('teste')->plainTextToken;

        return $token;
    }

    public function defaultHeaders()
    {
        $token = $this->createTokenWaiter();

        return [
            'Authorization' => "Bearer {$token}",
        ];
    }
}