<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Menu;

class MenuTest extends TestCase
{
    public function test_getMenu()
    {
        $menu = Menu::factory()->create();

        $response = $this->getJson("/cardapio/{$menu->id}/show");

        $response->assertStatus(200);
    }

    public function test_getMenu_notFound()
    {
        $response = $this->getJson("/cardapio/fake_id/show");

        $response->assertStatus(404);
    }

    public function test_createMenu()
    {   
        $response = $this->postJson("/cardapio/cadastro",[
                'name' => 'Pescados'
        ]);

        $response->assertStatus(201);
    }

    public function test_getAllCustomer()
    {
        Menu::factory()->count(10)->create();

        $response = $this->getJson("/cardapio/lista");

        $response->assertStatus(200)
                    ->assertJsonCount(Menu::count(), 'data');
    }

    public function test_updateMenu()
    {
        $menu = Menu::factory()->create();
        $menuUp = Menu::factory()->create();

        $response = $this->putJson("/cardapio/{$menu->id}/update",[
                                    'name' => $menuUp->name
                                ]);

        $response->assertStatus(200); 
    }

    public function test_deleteMenu()
    {
        $menu = Menu::inRandomOrder()->first();

        $response = $this->deleteJson("/cardapio/{$menu->id}/delete");

        $response->assertStatus(200);
    }
}
