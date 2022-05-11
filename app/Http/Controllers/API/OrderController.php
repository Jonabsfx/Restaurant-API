<?php

namespace App\Http\Controllers;


use App\Http\Resources\OrderResource;
use App\Http\Requests\
{
    StoreOrderRequest,
    StoreCustomerRequest,
    StoreTableRequest,
};
use App\Repositories\OrderRepository;

class OrderController extends Controller
{   

    protected $repository;


    public function __construct(OrderRepository $orderRepository)
    {
        $this->repository = $orderRepository;
    }

    public function create(StoreOrderRequest $request)
    {
        $data = $request->validate();

        $order = $this->repository
                         ->createNewOrder($data);

        return new OrderResource($order);
    }

    public function update(StoreOrderRequest $request)
    {
       return OrderResource::collection($this->repository->update($request));
    }

    public function delete(StoreOrderRequest $request)
    {
        return $this->repository->delete($request->id);
    }

    public function getAllPerTable(StoreTableRequest $request)
    {
        return OrderResource::collection($this->repository->getAllPerTable($request->id));
    }

    public function getAllPerEmployee()
    {
        return OrderResource::collection($this->repository->getAllPerEmployee());
    }

    public function getAllOnGoing()
    {
        return OrderResource::collection($this->repository->getAllOnGoing());
    }

    public function getAllToDo()
    {
        return OrderResource::collection($this->repository->getAllToDo());
    }

    public function getBiggestOrder(StoreCustomerRequest $request)
    {
        return OrderResource::collection($this->repository->getBiggestOrder($request->id));
    }

    public function getSmallestOrder(StoreCustomerRequest $request)
    {
        return OrderResource::collection($this->repository->getSmallestOrder($request->id));
    }

    public function getFirstOrder(StoreCustomerRequest $request)
    {
        return OrderResource::collection($this->repository->getFirstOrder($request->id));
    }

    public function getLastOrder(StoreCustomerRequest $request)
    {
        return OrderResource::collection($this->repository->getLastOrder($request->id));
    }

    public function getAllPerCustomer(StoreCustomerRequest $request)
    {
        return OrderResource::collection($this->repository->getAllPerCustomer($request->id));
    }

    public function getAllPerDay(int $year, int $month, int $day)
    {

        return OrderResource::collection($this->repository->getAllPerDay($year, $month, $day));
    }

    public function getAllPerMonth(int $year, int $month)
    {
        return OrderResource::collection($this->repository->getAllPerMonth($year, $month));
    }

    public function getAllPerWeek(int $year, int $month, int $day)
    {
        return OrderResource::collection($this->repository->getAllPerWeek($year, $month, $day));
    }

    public function start(StoreOrderRequest $request)
    {
        return OrderResource::collection($this->repository->start($request->id));
    }
    
    public function finish(StoreOrderRequest $request)
    {
        return OrderResource::collection($this->repository->finish($request->id));
    }
}

