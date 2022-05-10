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
    Route::get('/{id_menu}/show', [MenuController::class, 'read']);
    Route::put('/{id_menu}/update',[MenuController::class, 'update']);
    Route::delete('/{id_menu]/delete', [MenuController::class, 'delete']);
});

/**
 * CRUD dos Itens
 */
Route::prefix('/cardapio/{id_menu}')->group(function () {
    Route::post('/cadastro', [ItenController::class, 'create']);
    Route::get('/lista', [ItenController::class, 'read']);
    Route::put('/{id_iten}/update',[MenuController::class, 'update']);
    Route::delete('/{id_iten]/delete', [MenuController::class, 'delete']);
});

/**
 * CRUD da Mesa
 */
Route::prefix('/table')->group(function () {

    Route::get('/lista', [TableController::class, 'index']);
    Route::post('/cadastro', [TableController::class, 'create']);
    Route::get('/{id_table}/show', [TableController::class, 'read']);
    Route::put('/{id_table}/update',[TableController::class, 'update']);
    Route::delete('/{id_table}/delete', [TableController::class, 'delete']);
    Route::get('/{id_table}/list-pedidos', [OrderController::class, 'getAllPerTable']);

});

/**
 * CRUD do Cliente
 */
Route::prefix('/cliente')->group(function () {

    Route::get('/lista', [CustomerController::class, 'index']);
    Route::post('/cadastro', [CustomerController::class, 'create']);
    Route::get('/{id_customer}/show', [CustomerController::class, 'read']);
    Route::put('/{id_customer}/update',[CustomerController::class, 'update']);
    Route::delete('/{id_customer}/delete', [CustomerController::class, 'delete']);

});

/**
 * Métodos de Pedidos por Cliente
 */
Route::prefix('/cliente/{id_customer}')->group(function () {

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