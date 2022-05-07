<?php

namespace App\Repositories;

use App\Models\Mesa;
use App\Http\Requests\StoreMesaRequest;

class MesaRepository
{
    protected $entity;

    public function __construct(Mesa $model)
    {
        $this->entity = $model;
    }

    public function getAllMesas()
    {
        return $this->entity->with('pedidos')->get();
    }

    public function getMesa(string $identify)
    {
        return $this->entity->with('pedidos')->findOrFail($identify);
    }
    
    public function createNewMesa(StoreMesaRequest $request)
    {
        $data = $request->validated();
        $mesaModel = app(Mesa::class);
        $mesa = $mesaModel->create($data);
        return response()->json($mesa, 201);
    }

}