<?php
/*
namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Iten;
use App\Models\Menu;

class ItenTest extends TestCase
{

    public function test_createCustomer()
    {   
        $menu = Menu::factory()->create();

        $response = $this->postJson("/cardapio/{$menu->id}/cadastro-item",[
                'name' => 'Baião de Dois',
                'value' =>  25.50,
        ]);

        $response->assertStatus(201);
    }

    public function test_getAllCustomer()
    {   
        $menu = Menu::factory()->create();
        
        Iten::factory()->count(50)->create([
            'menu_id' => $menu->id,
        ]);

        $response = $this->getJson("/cardapio/{$menu->id}/lista-itens");

        $response->assertStatus(200)
                    ->assertJsonCount(Iten::where('menu_id', '=', $menu->id)->count(), 'data');
    }

    public function test_updateCustomer()
    {   
        $menu = Menu::factory()->create();

        $iten = Iten::factory()->create([
            'menu_id' => $menu->id,
        ]);
        $itenUp = Iten::factory()->create([
            'menu_id' => $menu->id,
        ]);

        $response = $this->putJson("/cliente/{$menu->id}/{$iten->id}/update",[
                                    'name' => $itenUp->name,
                                    'value' => $itenUp->value,
    ]);

        $response->assertStatus(200); 
    }

    public function test_deleteCustomer()
    {
        $iten = Iten::select('*')
                    ->first();

        $response = $this->deleteJson("/cardapio/{$iten->menu_id}/{$iten->id}/delete");

        $response->assertStatus(200);
    }
}*/