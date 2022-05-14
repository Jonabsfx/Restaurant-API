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

    public function getItensPerMenu($menu_id)
    {
        return  $this->entity
                        ->where('menu_id', $menu_id)
                        ->get();
      

     //   return response()->json($itens, 201);
    }
    
    public function createNewIten(StoreItenRequest $request, $menu_id)
    {
        $data = $request->validated();
        $menu = Menu::findOrFail($menu_id);

        $iten = $menu->itens()
                    ->create([
                        'name' => $data['name'],
                        'value' => $data['value'],
                    ]);


        return $iten;
    }

    public function update($iten_id,StoreItenRequest $request){

        $Iten = Iten::findOrFail($iten_id); 
        $Iten->name = $request->name;
        $Iten->save();

        return response()->json($Iten, 201);
    }

    public function delete($iten_id)
    {
      $iten = Iten::findOrFail($iten_id);
      $result = $iten->delete();

        return response()->json($result, 201);
    }
    

}