<?php

namespace App\Repositories;

use App\Http\Requests\StoreMenuRequest;
use App\Models\Menu;

class MenuRepository
{
    protected $entity;

    public function __construct(Menu $model)
    {
        $this->entity = $model;
    }

    public function getAllMenus()
    {
        return $this->entity->with('itens')->get();
    }

    public function getMenu(string $identify)
    {
        return $this->entity->with('itens')->findOrFail($identify);
    }
    
    public function createNewMenu(StoreMenuRequest $request)
    {
        $data = $request->validated();

        $menuModel = app(Menu::class);
        $menu = $menuModel->create($data);
        return $menu;
    }

    public function update(string $newName, $menu_id){

        $menu = Menu::findOrFail($menu_id); 
        $menu->name = $newName;
        $menu->save();

        return $menu;
    }

    public function delete($menu_id)
    {
        $menu = Menu::findOrFail($menu_id);
        $result = $menu->delete();

        return response()->json($result, 200);
    }
    

}