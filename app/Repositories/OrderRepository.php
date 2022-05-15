<?php

namespace App\Repositories;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Repositories\Traits\RepositoryTrait;
use App\Models\Iten;
use App\Models\Customer;
use Illuminate\Foundation\Http\Request;

class OrderRepository
{
    protected $entity;
    use RepositoryTrait;

    public function __construct(Order $model)
    {
        $this->entity = $model;
    }

    public function createNewOrder(StoreOrderRequest $request)
    {
        $data = $request->validated();
        
        $order = $this->entity
                      ->create([
                          "customer_id" => $data['customer_id'],
                          "table_id" => $data['table_id'],
                          "waiter_id" => $this->getWaiterAuth()->id
                      ]);
        return $order;
    }

    public function addIten($order_id, $iten_id)
    {
        $iten = Iten::findOrFail($iten_id);
        $order = Order::findOrFail($order_id);

        $result = $order->itens()->save($iten);

        $order->total += $iten->value;

        return response()->json($result, 201);
    }

    public function deleteIten($order_id, $iten_id)
    {
        $iten = Iten::findOrFail($iten_id);
        $order = Order::findOrFail($order_id);

        $result = $order->itens()->delete($iten);

        $order->total -= $iten->value;

        return response()->json($result, 201);
    }

    public function update(StoreOrderRequest $request)
    {

        $order = Order::findOrFail($request->id); 
        $order = $request->name;
        $order->save();

        return response()->json($order, 201);
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $result = $order->delete();

        return response()->json($result, 201);
    }

    public function start($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->status = 'A';
        $result = $order->save();

        return response()->json($result, 201);
    }

    public function finish($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->status = 'F';
        $result = $order->save();

        return response()->json($result, 201);
    }

    public function getAllPerEmployee()
    {
        $orders = Order::select('*')
                        ->where('waiter_id', '=', $this->getWaiterAuth()->id)
                     //   ->orwhere('chef_id', '=', $this->getChefAuth()->id)
                        ->get();
        return $orders;
    }
    
    public function getAllOnGoing()
    {
        $orders = Order::select('*')
                        ->where('status', 'A')
                        ->get();
        return $orders;
    }

    public function getAllToDo()
    {
        $orders = Order::select('*')
                        ->where('status', 'P')
                        ->get();
        return response()->json($orders, 200);
    }

    public function getBiggestOrder($customer_id)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->where('customer_id', $customer_id)
                        ->orderby('total', 'desc')
                        ->limit(1)
                        ->get();
        

        return $order;
    }
    
    public function getLowestOrder($customer_id)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->where('customer_id', $customer_id)
                        ->orderby('total', 'asc')
                        ->limit(1)
                        ->get();

        return $order;
    }

    
    public function getFirstOrder($customer_id)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->where('customer_id', $customer_id)
                        ->orderby('created_at', 'asc')
                        ->limit(1)
                        ->get();

        return $order;
    }

    public function getLastOrder($customer_id)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->where('customer_id', $customer_id)
                        ->orderby('created_at', 'desc')
                        ->limit(1)
                        ->get();

        return $order;
    }

    public function getAllPerCustomer($customer_id)
    {
        $orders = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->where('customer_id', $customer_id)
                        ->get();
        return $orders;
    }

    public function getAllPerTable($table_id)
    {
        $orders = Order::select('orders.*')
                        ->join('tables', 'tables.id', '=', 'orders.table_id')
                        ->where('table_id', $table_id)
                        ->get();
        return $orders;
    }

    public function getAllPerDay($year, $month, $day)
    {
        $orders = Order::select('orders.*')
                        ->whereYear('orders.created_at', '=', $year)
                        ->whereMonth('orders.created_at', '=', $month)
                        ->whereDay('orders.created_at', '=', $day)
                        ->get();

        return $orders;
    }

    public function getAllPerMonth($year, $month)
    {
        $orders = Order::select('orders.*')
                        ->whereYear('orders.created_at', '=', $year)
                        ->whereMonth('orders.created_at', '=', $month)
                        ->get();

        return $orders;
    }

    public function getAllPerWeek($year, $month, $firstDay)
    {
        $lastDay = $firstDay + 6;

        $orders = Order::select('orders.*')
                        ->whereYear('orders.created_at', '=', $year)
                        ->whereMonth('orders.created_at', '=', $month)
                        ->whereBetweenDay('orders.created_at', [$firstDay, $lastDay])
                        ->get();
        
        return $orders;
    }


}