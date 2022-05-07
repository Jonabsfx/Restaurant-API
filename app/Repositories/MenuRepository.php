<?php

namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Http\Request;

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
    
    public function createNewMenu(Request $request)
    {
        $menuModel = app(Menu::class);
        $menu = $menuModel->create($request);
        return response()->json($menu, 201);
    }

}