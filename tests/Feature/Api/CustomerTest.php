<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;
use App\Models\Customer;
use Database\Factories\CustomerFactory;

class CustomerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getCustomer()
    {
        $customer = Customer::factory()->create();

        $response = $this->getJson("/cliente/{$customer->id}/show");

        $response->assertStatus(200);
    }

    public function test_getCustomer_notFound()
    {
        $response = $this->getJson("/cliente/fake_id/show");

        $response->assertStatus(404);
    }

    public function test_createCustomer()
    {   
        $response = $this->postJson("/cliente/cadastro",[
                'name' => 'HP Lovecraft',
                'cpf' =>  "93882628596",
        ]);

        $response->assertStatus(201);
    }

    public function test_getAllCustomer()
    {
        Customer::factory()->count(10)->create();

        $response = $this->getJson("/cliente/lista");

        $response->assertStatus(200)
                    ->assertJsonCount(Customer::count(), 'data');
    }

    public function test_updateCustomer()
    {
        $customer = Customer::factory()->create();
        $customerUp = Customer::factory()->create();

        $response = $this->putJson("/cliente/{$customer->id}/update",[
                                    'name' => $customerUp->name
    ]);

        $response->assertStatus(200); 
    }

    public function test_deleteCustomer()
    {
        $customer = Customer::select('*')
                                ->where("cpf",'=',"93882628596")
                                ->first();

        $response = $this->deleteJson("/cliente/{$customer->id}/delete");

        $response->assertStatus(200);
    }
}
