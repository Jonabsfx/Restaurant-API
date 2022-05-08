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
        return $this->entity->with('orders')->get();
    }

    public function getMenu(string $identify)
    {
        return $this->entity->with('orders')->findOrFail($identify);
    }
    
    public function createNewMenu(StoreMenuRequest $request)
    {
        $data = $request->validate();

        $menuModel = app(Menu::class);
        $menu = $menuModel->create($data);
        return response()->json($menu, 201);
    }

    public function update(StoreMenuRequest $request){

        $menu = Menu::findOrFail($request->id); 
        $menu->name = $request->name;
        $menu->save();

        return response()->json($menu, 201);
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
    }
    

}