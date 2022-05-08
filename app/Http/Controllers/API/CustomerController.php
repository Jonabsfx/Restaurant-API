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

    public function read($id)
    {
        return new CustomerResource($this->repository->getCustomer($id));
    }

    public function create(StoreCustomerRequest $request)
    {
         $customer = $this->repository
                         ->createNewCustomer($request);

        return new CustomerResource($customer);
    }
    

    public function update(StoreCustomerRequest $request)
    {
        $this->repository->update($request);
    }

    public function delete(StoreCustomerRequest $request)
    {
        $this->repository->update($request->id);
    }

    
}
