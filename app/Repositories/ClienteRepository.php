<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;

class ClienteRepository
{
    protected $entity;

    public function __construct(Cliente $model)
    {
        $this->entity = $model;
    }

    public function getAllClientes()
    {
        return $this->entity->with('pedidos')->get();
    }

    public function getCliente(string $identify)
    {
        return $this->entity->with('pedidos')->findOrFail($identify);
    }
    
    public function createNewCliente(StoreClienteRequest $request)
    {
        $data = $request->validated();

        if(ClienteRepository::validaCPF($data->cpf))
        {

        $clienteModel = app(Cliente::class);
        $cliente = $clienteModel->create($data);
        return response()->json($$cliente, 201);

        }

        else
        {
            return response()->json(400);
        }
    }

    private function validaCPF($cpf) {
 
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    
    }
}