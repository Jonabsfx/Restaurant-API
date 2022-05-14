<?php

namespace App\Repositories\Traits;


use App\Models\Waiter;
use App\Models\Chef;

trait RepositoryTrait
{
    private function getWaiterAuth(): Waiter
    {
        return auth()->guard('waiter')->user();
    }

    private function getChefAuth(): Chef
    {
        return auth()->guard('chef')->user();
    }
}