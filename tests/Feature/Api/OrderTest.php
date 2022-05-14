<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{
    Order,
    Table,
    Customer,
    Waiter,
    Chef
};

class OrderTest extends TestCase
{
    use UtilsTrait;

    public function test_getAllPerTable()
    {
        $table = Table::factory()->create();
        Order::factory()->count(50)->make([
            'table_id' => $table->id,
        ]);

        $count = Order::select()
                        ->where('table_id', '=', $table->id);
        
        $response = $this->get("/{$table->id}/lista-pedidos", $this->defaultHeaders());
    
        $response->assertStatus(200)
                    ->assertJsonCount($count, 'data');
    }
}
