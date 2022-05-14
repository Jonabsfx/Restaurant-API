<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use App\Repositories\CustomerRepository;
use App\Http\Requests\StoreCustomerRequest;

class CustomerController extends Controller
{
    protected $repository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->repository = $customerRepository;
    }

    public function index()
    {
        return CustomerResource::collection($this->repository->getAllCustomers());
    }

    public function read($customer_id)
    {
        return new CustomerResource($this->repository->getCustomer($customer_id));
    }

    public function create(StoreCustomerRequest $request)
    {

        $customer = $this->repository
                       ->createNewCustomer($request);

        return new CustomerResource($customer); 
    }
    

    public function update($customer_id, Request $request)
    {
        $newName = $request->name;
      
        $customer = $this->repository->update($customer_id, $newName);
 
        return new CustomerResource($customer); 
    }

    public function delete($customer_id)
    {
       return $this->repository->delete($customer_id);
    }

    
}
