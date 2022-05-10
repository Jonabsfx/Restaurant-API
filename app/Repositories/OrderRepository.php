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

    public function addIten($id_order, $id_iten)
    {
        $iten = Iten::findOrFail($id_iten);
        $order = Order::findOrFail($id_order);

        $result = $order->itens()->save($iten);

        $order->total += $iten->value;

        return response()->json($result, 201);
    }

    public function deleteIten($id_order, $id_iten)
    {
        $iten = Iten::findOrFail($id_iten);
        $order = Order::findOrFail($id_order);

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

    public function start($id_order)
    {
        $order = Order::findOrFail($id_order);
        $order->status = 'A';
        $result = $order->save();

        return response()->json($result, 201);
    }

    public function finish($id_order)
    {
        $order = Order::findOrFail($id_order);
        $order->status = 'F';
        $result = $order->save();

        return response()->json($result, 201);
    }

    public function getAllPerEmployee()
    {
        $order = Order::select('*')
                        ->where('id_waiter', '=', $this->getUserAuth()->id())
                        ->orwhere('id_chef', '=', $this->getUserAuth()->id())
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

    public function getBiggestOrder($id_customer)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.id_customer')
                        ->where('id_customer', $id_customer)
                        ->orderby('order.total', 'desc')
                        ->limit(1)
                        ->get();

        return response()->json($order, 200);
    }
    
    public function getSmallestOrder($id_customer)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.id_customer')
                        ->where('id_customer', $id_customer)
                        ->orderby('order.total', 'cresc')
                        ->limit(1)
                        ->get();

        return response()->json($order, 200);
    }

    
    public function getFirstOrder($id_customer)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.id_customer')
                        ->where('id_customer', $id_customer)
                        ->orderby('created_at', 'cresc')
                        ->limit(1)
                        ->get();

        return response()->json($order, 200);
    }

    public function getLastOrder($id_customer)
    {
        $order = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.id_customer')
                        ->where('id_customer', $id_customer)
                        ->orderby('created_at', 'desc')
                        ->limit(1)
                        ->get();

        return response()->json($order, 200);
    }

    public function getAllPerCustomer($id_customer)
    {
        $orders = Order::select('orders.*')
                        ->join('customers', 'customers.id', '=', 'orders.id_customer')
                        ->where('id_customer', $id_customer)
                        ->get();
        return response()->json($orders, 200);
    }

    public function getAllPerTable($id_table)
    {
        $orders = Order::select('orders.*')
                        ->join('tables', 'tables.id', '=', 'orders.id_table')
                        ->where('id_table', $id_table)
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