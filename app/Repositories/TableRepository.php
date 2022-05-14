<?php

namespace App\Repositories;

use App\Models\Table;
use App\Http\Requests\StoreTableRequest;
use App\Models\Order;

class TableRepository
{
    protected $entity;

    public function __construct(Table $model)
    {
        $this->entity = $model;
    }

    public function getAllTables()
    {
        return $this->entity->get();
    }

    public function getTable(string $identify)
    {
        return $this->entity->findOrFail($identify);
    }
    
    public function createNewTable(StoreTableRequest $request)
    {
        $data = $request->validated();
        $table = $this->entity
                            ->create([
                                'number' => $data['number'],
                            ]);
        return $table;
    }

    public function update(StoreTableRequest $request, $table_id){
        $data = $request->validated();

        $table = Table::findOrFail($table_id); 
        $table->number = $data['number'];
        $table->save();

        return $table;
    }

    public function delete($id)
    {
        $table = Table::findOrFail($id);
        $result = $table->delete();

        return response()->json($result, 200);
    }

}