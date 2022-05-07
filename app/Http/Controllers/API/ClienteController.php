<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClienteResource;
use Illuminate\Http\Request;
use App\Repositories\ClienteRepository;
use App\Http\Requests\StoreClienteRequest;

class ClienteController extends Controller
{
    protected $repository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->repository = $clienteRepository;
    }

    public function index()
    {
        return ClienteResource::collection($this->repository->getAllClientes());
    }

    public function read($id)
    {
        return new ClienteResource($this->repository->getCliente($id));
    }

    public function create(StoreClienteRequest $request)
    {
         $cliente = $this->repository
                         ->createNewCliente($request);

        return new ClienteResource($cliente);
    }
 

    
}
