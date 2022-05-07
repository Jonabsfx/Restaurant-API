<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardapioResource;
use Illuminate\Http\Request;
use App\Repositories\CardapioRepository;

class CardapioController extends Controller
{
    protected $repository;

    public function __construct(CardapioRepository $cardapioRepository)
    {
        $this->repository = $cardapioRepository;
    }

    public function index()
    {
        return CardapioResource::collection($this->repository->getAllCardapios());
    }

    public function read($id)
    {
        return new CardapioResource($this->repository->getCardapio($id));
    }

    public function create(Request $request)
    {
         $cardapio = $this->repository
                         ->createNewCardapio($request);

        return new CardapioResource($cardapio);
    }
 

    
}