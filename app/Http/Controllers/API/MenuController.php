<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Resources\MenuResource;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $repository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->repository = $menuRepository;
    }

    public function index()
    {
        return MenuResource::collection($this->repository->getAllMenus());
    }

    public function read($menu_id)
    {
        return new MenuResource($this->repository->getMenu($menu_id));
    }

    public function create(StoreMenuRequest $request)
    {
         $menu = $this->repository
                         ->createNewMenu($request);

        return new MenuResource($menu);
    }

    public function update(StoreMenuRequest $request)
    {
        return MenuResource::collection($this->repository->update($request));
    }

    public function delete(StoreMenuRequest $request)
    {
        return $this->repository->delete($request->id);
    }
    

    
}