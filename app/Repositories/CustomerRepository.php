<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Http\Request;

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

        if($this->validaCPF($data["cpf"]))
        {
        $customer = $this->entity
                            ->create([
                                'name' => $data['name'],
                                'cpf' => $data['cpf'],
                            ]);

       return $customer;

        }

        else
        {
            return response()->json(400);
        }
    }

    public function update($customer_id, string $newName){


        $customer = Customer::findOrFail($customer_id); 
        $customer->name = $newName;
        $customer->save();

       return $customer;
 
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(204);
    }

    private function validaCPF($cpf) 
    {
 
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