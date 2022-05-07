<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;
use Illuminate\Http\Request;
use App\Repositories\TableRepository;
use App\Http\Requests\StoreTableRequest;

class TableController extends Controller
{
    protected $repository;

    public function __construct(TableRepository $tableRepository)
    {
        $this->repository = $tableRepository;
    }

    public function index()
    {
        return TableResource::collection($this->repository->getAllTables());
    }

    public function read($id)
    {
        return new TableResource($this->repository->getTable($id));
    }

    public function create(StoreTableRequest $request)
    {
         $table = $this->repository
                         ->createNewTable($request);

        return new TableResource($table);
    }
 

    
}