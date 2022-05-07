<?php

namespace App\Repositories;

use App\Models\Table;
use App\Http\Requests\StoreTableRequest;

class TableRepository
{
    protected $entity;

    public function __construct(Table $model)
    {
        $this->entity = $model;
    }

    public function getAllTables()
    {
        return $this->entity->with('orders')->get();
    }

    public function getTable(string $identify)
    {
        return $this->entity->with('orders')->findOrFail($identify);
    }
    
    public function createNewTable(StoreTableRequest $request)
    {
        $data = $request->validated();
        $tableModel = app(Table::class);
        $table = $tableModel->create($data);
        return response()->json($table, 201);
    }

}