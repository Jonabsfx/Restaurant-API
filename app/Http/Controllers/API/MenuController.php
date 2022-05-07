<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Request;
use App\Repositories\MenuRepository;

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

    public function read($id)
    {
        return new MenuResource($this->repository->getMenu($id));
    }

    public function create(Request $request)
    {
         $menu = $this->repository
                         ->createNewMenu($request);

        return new MenuResource($menu);
    }
 

    
}