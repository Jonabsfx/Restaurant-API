<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItenRequest;
use App\Http\Resources\ItenResource;
use App\Repositories\ItenRepository;

class ItenController extends Controller
{
    protected $repository;


    public function __construct(ItenRepository $itenRepository)
    {
        $this->repository = $itenRepository;
    }

    public function read($menu_id)
    {
        return ItenResource::collection($this->repository->getItensPerMenu($menu_id));
    }

    public function create(StoreItenRequest $request, $menu_id)
    {
         $iten = $this->repository
                         ->createNewIten($request, $menu_id);

        return new ItenResource($iten);
    }

    public function update($iten_id,StoreItenRequest $request)
    {
        return ItenResource::collection($this->repository->update($iten_id,$request));
    }

    public function delete($menu_id, $iten_id)
    {
        return ItenResource::collection($this->repository->delete($iten_id));
    }
}
