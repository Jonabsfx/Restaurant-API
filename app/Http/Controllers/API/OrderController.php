<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StoreOrderRequest;
use App\Repositories\OrderRepository;
use Illuminate\Foundation\Http\Request;

class OrderController extends Controller
{   

    protected $repository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->repository = $orderRepository;
    }

    public function create(StoreOrderRequest $request)
    {
        dd($request);
        $order = $this->repository
                        ->createNewOrder($request);

                        
        return new OrderResource($order);
    }

    public function update(StoreOrderRequest $request, $order_id)
    {
       return OrderResource::collection($this->repository->update($request, $order_id));
    }

    public function delete($order_id)
    {
        return $this->repository->delete($order_id);
    }

    public function getAllPerTable($table_id)
    {
        return OrderResource::collection($this->repository->getAllPerTable($table_id));
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

    public function getBiggestOrder($customer_id)
    {
        return OrderResource::collection($this->repository->getBiggestOrder($customer_id));
    }

    public function getSmallestOrder($customer_id)
    {
        return OrderResource::collection($this->repository->getSmallestOrder($customer_id));
    }

    public function getFirstOrder($customer_id)
    {
        return OrderResource::collection($this->repository->getFirstOrder($customer_id));
    }

    public function getLastOrder($customer_id)
    {
        return OrderResource::collection($this->repository->getLastOrder($customer_id));
    }

    public function getAllPerCustomer($customer_id)
    {
        return OrderResource::collection($this->repository->getAllPerCustomer($customer_id));
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

    public function start($order_id)
    {
        return OrderResource::collection($this->repository->start($order_id));
    }
    
    public function finish($order_id)
    {
        return OrderResource::collection($this->repository->finish($order_id));
    }

    public function addIten(StoreOrderRequest $request, $iten_id)
    {
        return $this->repository->addIten($request->id, $iten_id);
    }
}

