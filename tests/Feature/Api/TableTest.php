<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Table;
use App\Models\Order;

class TableTest extends TestCase
{

    public function test_getTable()
    {
        $table = Table::factory()->create();

        $response = $this->getJson("/mesa/{$table->id}/show");

        $response->assertStatus(200);
    }

    public function test_getTable_notFound()
    {
        $response = $this->getJson("/mesa/fake_id/show");

        $response->assertStatus(404);
    }

    public function test_createTable()
    {   
        $response = $this->postJson("/mesa/cadastro",[
                'number' =>  random_int(1,99),
        ]);

        $response->assertStatus(201);
    }

    public function test_getAllTable()
    {
        Table::factory()->count(10)->create();

        $response = $this->getJson("/mesa/lista");

        $response->assertStatus(200)
                    ->assertJsonCount(Table::count(), 'data');
    }

    public function test_deleteTable()
    {
        $table = Table::inRandomOrder()->first();

        $response = $this->deleteJson("/mesa/{$table->id}/delete");

        $response->assertStatus(200);
    }
}
