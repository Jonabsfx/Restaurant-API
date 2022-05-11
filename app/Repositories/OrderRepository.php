<?php

namespace App\Repositories;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Repositories\Traits\RepositoryTrait;
use App\Models\Iten;

class OrderRepository
{
    protected $entity;
    use RepositoryTrait;

    public function __construct(Order $model)
    {
        $this->entity = $model;
    }

    public function createNewOrder(array $data)
    {
        $order = $this->getUserAuth()
                      ->orders()
                      ->create([
                        'table_id' => $data['table_id'],
                        'customer_id' => $data['customer_id'],
                        'total' => $data['total'],
                      ]);

        return response()->json($order, 201);
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
        $order = Order::select('*')
                        ->where('waiter_id', '=', $this->getUserAuth()->id())
                        ->orwhere('chef_id', '=', $this->getUserAuth()->id())
                        ->get();
        return response()->json($order, 200);
    }
    
    public function getAllOnGoing()
    {
        $orders = Order::select('*')
                        ->where('status', 'A')
                        ->get();
        return response()->json($orders, 200);
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
                        ->orderby('order.total', 'desc')
                        ->limit(1)
                        ->get();

        return response()->json($order, 200);
    }
    
    public function getSmallestOrder($customer_id)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->where('customer_id', $customer_id)
                        ->orderby('order.total', 'cresc')
                        ->limit(1)
                        ->get();

        return response()->json($order, 200);
    }

    
    public function getFirstOrder($customer_id)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->where('customer_id', $customer_id)
                        ->orderby('created_at', 'cresc')
                        ->limit(1)
                        ->get();

        return response()->json($order, 200);
    }

    public function getLastOrder($customer_id)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->where('customer_id', $customer_id)
                        ->orderby('created_at', 'desc')
                        ->limit(1)
                        ->get();

        return response()->json($order, 200);
    }

    public function getAllPerCustomer($customer_id)
    {
        $orders = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->where('customer_id', $customer_id)
                        ->get();
        return response()->json($orders, 200);
    }

    public function getAllPerTable($table_id)
    {
        $orders = Order::select('orders.*')
                        ->join('tables', 'tables.id', '=', 'orders.table_id')
                        ->where('table_id', $table_id)
                        ->get();
        return response()->json($orders, 200);
    }

    public function getAllPerDay($year, $month, $day)
    {
        $orders = Order::select('orders.*')
                        ->whereYear('orders.created_at', '=', $year)
                        ->whereMonth('orders.created_at', '=', $month)
                        ->whereDay('orders.created_at', '=', $day)
                        ->get();

        return response()->json($orders, 200);
    }

    public function getAllPerMonth($year, $month)
    {
        $orders = Order::select('orders.*')
                        ->whereYear('orders.created_at', '=', $year)
                        ->whereMonth('orders.created_at', '=', $month)
                        ->get();

        return response()->json($orders, 200);
    }

    public function getAllPerWeek($year, $month, $firstDay)
    {
        $lastDay = $firstDay + 6;

        $orders = Order::select('orders.*')
                        ->whereYear('orders.created_at', '=', $year)
                        ->whereMonth('orders.created_at', '=', $month)
                        ->whereBetweenDay('orders.created_at', [$firstDay, $lastDay])
                        ->get();
        
        return response()->json($orders, 200);
    }


}