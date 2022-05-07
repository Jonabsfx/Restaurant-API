<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;

class CustomerRepository
{
    protected $entity;

    public function __construct(Customer $model)
    {
        $this->entity = $model;
    }

    public function getAllCustomers()
    {
        return $this->entity->with('orders')->get();
    }

    public function getCustomer(string $identify)
    {
        return $this->entity->with('orders')->findOrFail($identify);
    }
    
    public function createNewCustomer(StoreCustomerRequest $request)
    {
        $data = $request->validated();

        if(CustomerRepository::validaCPF($data->cpf))
        {

        $customerModel = app(Customer::class);
        $customer = $customerModel->create($data);
        return response()->json($$customer, 201);

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