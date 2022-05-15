<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Iten;
use App\Models\Menu;

class ItenTest extends TestCase
{

    public function test_createIten()
    {   
        $menu = Menu::factory()->create();
        $iten = Iten::factory()->create();

        $response = $this->postJson("/cardapio/{$menu->id}/cadastro-iten",[
                'name' => $iten->name,
                'value' =>  $iten->value,
        ]);

        $response->assertStatus(201);
    }

    public function test_getAllIten()
    {   
        $menu = Menu::factory()->create();
        
        Iten::factory()->count(50)->create([
            'menu_id' => $menu->id,
        ]);

        $count = $menu->itens()->count();

        $response = $this->getJson("/cardapio/{$menu->id}/lista-itens");

        $response->assertStatus(200)
                    ->assertJsonCount($count, 'data');
    }

    public function test_updateIten()
    {   
        $menu = Menu::factory()->create();

        $iten = Iten::factory()->create([
            'menu_id' => $menu->id,
        ]);
        $itenUp = Iten::factory()->create([
            'menu_id' => $menu->id,
        ]);

        $response = $this->putJson("/cardapio/{$menu->id}/{$iten->id}/update-item",[
                                    'name' => $itenUp->name,
                                    'value' => $itenUp->value,
    ]);

        $response->assertStatus(200); 
    }

    public function test_deleteIten()
    {
        $iten = Iten::select('*')
                    ->first();

        $response = $this->deleteJson("/cardapio/{$iten->menu_id}/{$iten->id}/deletar-item");

        $response->assertStatus(201);
    }
}