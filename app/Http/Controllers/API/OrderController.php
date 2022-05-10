<?php

namespace App\Http\Controllers;


use App\Http\Resources\OrderResource;
use App\Http\Requests\
{
    StoreOrderRequest,
    StoreCustomerRequest,
    StoreTableRequest,
};
use DateTime;

class OrderController extends Controller
{   

    public function index()
    {
        return OrderResource::collection($this->repository->getAllMenus());
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
        $this->repository->update($request);
    }

    public function delete(StoreOrderRequest $request)
    {
        $this->repository->delete($request->id);
    }

    public function getAllPerTable(StoreTableRequest $request)
    {
        $this->repository->getAllPerTable($request->id);
    }

    public function getAllPerEmployee()
    {
        $this->repository->getAllPerEmployee();
    }

    public function getAllOnGoing()
    {
        $this->repository->getAllOnGoing();
    }

    public function getAllToDo()
    {
        $this->repository->getAllToDo();
    }

    public function getBiggestOrder(StoreCustomerRequest $request)
    {
        $this->repository->getBiggestOrder($request->id);
    }

    public function getSmallestOrder(StoreCustomerRequest $request)
    {
        $this->repository->getSmallestOrder($request->id);
    }

    public function getFirstOrder(StoreCustomerRequest $request)
    {
        $this->repository->getFirstOrder($request->id);
    }

    public function getLastOrder(StoreCustomerRequest $request)
    {
        $this->repository->getLastOrder($request->id);
    }

    public function getAllPerCustomer(StoreCustomerRequest $request)
    {
        $this->repository->getAllPerCustomer($request->id);
    }

    public function getAllPerDay(int $year, int $month, int $day)
    {

        $this->repository->getAllPerDay($year, $month, $day);
    }

    public function getAllPerMonth(int $year, int $month)
    {
        $this->repository->getAllPerMonth($year, $month);
    }

    public function getAllPerWeek(int $year, int $month, int $day)
    {
        $this->repository->getAllPerWeek($year, $month, $day);
    }

    public function start(StoreOrderRequest $request)
    {
        $this->repository->start($request->id);
    }
    
    public function finish(StoreOrderRequest $request)
    {
        $this->repository->finish($request->id);
    }
}

