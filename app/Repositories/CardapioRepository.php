<?php

namespace App\Repositories;

use App\Models\Cardapio;
use Illuminate\Http\Request;

class CardapioRepository
{
    protected $entity;

    public function __construct(Cardapio $model)
    {
        $this->entity = $model;
    }

    public function getAllCardapios()
    {
        return $this->entity->with('pedidos')->get();
    }

    public function getCardapio(string $identify)
    {
        return $this->entity->with('pedidos')->findOrFail($identify);
    }
    
    public function createNewCardapio(Request $request)
    {
        $cardapioModel = app(Cardapio::class);
        $cardapio = $cardapioModel->create($request);
        return response()->json($cardapio, 201);
    }

}