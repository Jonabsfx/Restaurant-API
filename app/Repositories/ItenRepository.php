<?php

namespace App\Repositories;

use App\Http\Requests\StoreItenRequest;
use App\Models\Iten;
use App\Models\Menu;

class ItenRepository
{
    protected $entity;

    public function __construct(Iten $model)
    {
        $this->entity = $model;
    }

    public function getItensPerMenu($id_menu)
    {
        $itens = Menu::select('*')
                        ->where('id_menu', $id_menu)
                        ->get();

        return response($itens, 200);
    }
    
    public function createNewMenu(StoreItenRequest $request, $id_menu)
    {
        $data = $request->validate();
        $menu = Menu::findOrFail($id_menu);

        $iten = $menu->itens()
                    ->create([
                        'name' => $data['name'],
                        'value' => $data['value'],
                    ]);


        return response()->json($iten, 201);
    }

    public function update(StoreItenRequest $request){

        $Iten = Iten::findOrFail($request->id); 
        $Iten->name = $request->name;
        $Iten->save();

        return response()->json($Iten, 201);
    }

    public function delete($id)
    {
        $Iten = Iten::findOrFail($id);
        $Iten->delete();
    }
    

}