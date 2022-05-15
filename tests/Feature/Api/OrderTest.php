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
    Chef,
    Iten
};
use App\Repositories\OrderRepository;

class OrderTest extends TestCase
{
    use UtilsTrait;

    public function test_getAllPerTable()
    {
        $table = Table::select('*')->first();
    
        Order::factory()->
                count(20)->
                create([
                    'table_id' => $table->id,
                ]);

        $count = $table->orders()->count();
        
        $response = $this->get("/mesa/{$table->id}/lista-pedidos", $this->defaultHeaders());
    
        $response->assertStatus(200)
                    ->assertJsonCount($count, 'data');
    }

    public function test_getAllPerCustomer()
    {
        $customer = Customer::factory()->create();
    
        $order = Order::factory()->
                count(20)->
                create([
                    'customer_id' => $customer->id,
                ]);

        $count = $customer->orders()->count();
        
        $response = $this->get("/cliente/{$customer->id}/lista-pedidos", $this->defaultHeaders());
    
        $response->assertStatus(200)
                    ->assertJsonCount($count, 'data');
    }

    public function test_getBiggestOrder()
    {
        $customer = Customer::factory()->create();
        

        for($i=0;$i<2;$i++)
        {   
            $order = Order::factory()->
                    create([
                        'customer_id' => $customer->id,
                    ]); 
            $total = 0;
            for($j=0;$j<5;$j++)
            {
                $iten = Iten::factory()->create();
                $order->itens()->save($iten);
                $total = $total + $iten->value; 
            }
            $order->total = $total;
            $order->save();
        }
        
        $response = $this->get("/cliente/{$customer->id}/maior-pedido", $this->defaultHeaders());
        $response->assertStatus(200);}

    public function test_getLowestOrder()
    {
        $customer = Customer::factory()->create();

        for($i=0;$i<2;$i++)
        {   
            $order = Order::factory()->
                    create([
                        'customer_id' => $customer->id,
                    ]); 
            $total = 0;
            for($j=0;$j<5;$j++)
            {
                $iten = Iten::factory()->create();
                $order->itens()->save($iten);
                $total = $total + $iten->value; 
            }
        }

        $response = $this->get("/cliente/{$customer->id}/menor-pedido", $this->defaultHeaders());
        $response->assertStatus(200);
    }

    public function test_getFirstOrder()
    {
        $customer = Customer::factory()->create();

        Order::factory()->
                count(20)->
                create([
                    'customer_id' => $customer->id,
                ]);
        $response = $this->get("/cliente/{$customer->id}/primeiro-pedido", $this->defaultHeaders());
        
        $response->assertStatus(200);
    }

    public function test_getLastOrder()
    {
        $customer = Customer::factory()->create();

        Order::factory()->
                count(20)->
                create([
                    'customer_id' => $customer->id,
                ]);
        $response = $this->get("/cliente/{$customer->id}/ultimo-pedido", $this->defaultHeaders());
        
        $response->assertStatus(200);
    }
}