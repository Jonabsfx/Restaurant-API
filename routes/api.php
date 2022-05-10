<?php

use App\Http\Controllers\API\
{
    CustomerController,
    MenuController,
    EmployeeController,
    OrderController,
    TableController,
};
use App\Http\Controllers\Auth\{
    AuthController,
    ResetPasswordController
};
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Autenticação
 */
Route::post('/login-waiter', [WaiterAuthController::class, 'login']);
Route::post('/login-chef', [ChefAuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

/**
 * Resetar a Senha
 */
Route::post('/esqueci-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/resetar-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');

Route::get('/lista-customers', [CustomerController::class, 'index']);

/**
 * CRUD do Cardápio
 */
Route::prefix('/cardapio')->group(function () {
    Route::get('/lista', [MenuController::class, 'index']);
    Route::post('/cadastro', [MenuController::class, 'create']);
    Route::get('/{id_cardapio}/show', [MenuController::class, 'read']);
    Route::put('/{id_cardapio}/update',[MenuController::class, 'update']);
    Route::delete('/{id_cardapio]/delete', [MenuController::class, 'delete']);
});

/**
 * CRUD do Cliente
 */
Route::prefix('/cliente')->group(function () {

    Route::get('/lista', [CustomerController::class, 'index']);
    Route::post('/cadastro', [MenuController::class, 'create']);
    Route::get('/{id_cliente}/show', [MenuController::class, 'read']);
    Route::put('/{id_cliente}/update',[MenuController::class, 'update']);
    Route::delete('/{id_cliente}/delete', [MenuController::class, 'delete']);

});

/**
 * Métodos de Pedidos por Cliente
 */
Route::prefix('/cliente/{id_cliente}')->group(function () {

    Route::get('/maior-pedido', [OrderController::class, 'getBiggestOrder']);
    Route::get('/menor-pedido', [OrderController::class, 'getSmallestOrder']);
    Route::get('/primeiro-pedido', [OrderController::class, 'getFirstOrder']);
    Route::get('/ultimo-pedido', [OrderController::class, 'getLastOrder']);
    Route::get('/lista-pedidos', [OrderController::class, 'getAllPerCustomer']);

});

/**
 * Métodos de Busca Temporal por Pedido
 */
Route::get('/pedidos/lista-mes/{year}/{month}', [OrderController::class, 'getAllPerMonth']);
Route::get('/pedidos/lista-dia/{year}/{month}/{day}', [OrderController::class, 'getAllPerDay']);
Route::get('/pedidos/lista-semana/{year}/{month}/{day}', [OrderController::class, 'getAllPerWeek']);

/***
 * Métodos de Pedidos por Mesa
 */

Route::get('/pedidos/lista-mesa/{id_table}', [OrderController::class, 'getAllPerTable']);

// Rotas do Garçcom
Route::middleware(['auth:sanctum', 'type.waiter'])->group(function () {
    Route::post('criar-pedido', [OrderController::class, 'createNewOrder']);
    Route::get('lista-pedidos',[OrderController::class, 'getAllPerEmployee']);
    Route::get('lista-em-andamento', [OrderController::class, 'getAllOnGoing']);
    
});

// Rotas do Chef
Route::middleware(['auth:sanctum', 'type.chef'])->group(function () {
    Route::get('lista-pedidos',[OrderController::class, 'getAllPerEmployee']);
    Route::get('lista-em-andamento', [OrderController::class, 'getAllOnGoing']);
    Route::get('lista-a-fazer', [OrderController::class, 'getAllToDo']);
    Route::post('/{id_order}/iniciar-pedido', [OrderController::class, 'start']);
    Route::post('/{id_order}/finalizar-pedido', [OrderController::class, 'finish']);
    
});

Route::get('/', function(){

    return response()->json([
            'success' => true,
        ]);
});