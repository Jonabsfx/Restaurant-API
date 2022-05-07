<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MesaResource;
use Illuminate\Http\Request;
use App\Repositories\MesaRepository;
use App\Http\Requests\StoreMesaRequest;

class MesaController extends Controller
{
    protected $repository;

    public function __construct(MesaRepository $mesaRepository)
    {
        $this->repository = $mesaRepository;
    }

    public function index()
    {
        return MesaResource::collection($this->repository->getAllMesas());
    }

    public function read($id)
    {
        return new MesaResource($this->repository->getMesa($id));
    }

    public function create(StoreMesaRequest $request)
    {
         $mesa = $this->repository
                         ->createNewMesa($request);

        return new MesaResource($mesa);
    }
 

    
}