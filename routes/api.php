<?php

use App\Http\Controllers\API\
{
    CustomerController,
    MenuController,
    TableController,
    ItenController,
    OrderController
};
use App\Http\Controllers\Auth\{
    AuthController,
    ResetPasswordController,
    ChefAuthController,
    WaiterAuthController,
};
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

Route::post('/criar-pedido', [OrderController::class, 'create']);

/**
 * Autenticação
 */
Route::post('/login-waiter', [WaiterAuthController::class, 'login']);
Route::post('/login-chef', [ChefAuthController::class, 'login']);

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
    Route::get('/{menu_id}/show', [MenuController::class, 'read']);
    Route::put('/{menu_id}/update',[MenuController::class, 'update']);
    Route::delete('/{menu_id}/delete', [MenuController::class, 'delete']);
});

/**
 * CRUD dos Itens
 */
Route::prefix('/cardapio/{menu_id}')->group(function () {
    Route::post('/cadastro', [ItenController::class, 'create']);
    Route::get('/lista-itens', [ItenController::class, 'read']);
    Route::put('/{iten_id}/update-item',[ItenController::class, 'update']);
    Route::delete('/{iten_id}/deletar-item', [ItenController::class, 'delete']);
}); 

/**
 * CRUD da Mesa
 */
Route::prefix('/mesa')->group(function () {

    Route::get('/lista', [TableController::class, 'index']);
    Route::post('/cadastro', [TableController::class, 'create']);
    Route::get('/{table_id}/show', [TableController::class, 'read']);
    Route::put('/{table_id}/update',[TableController::class, 'update']);
    Route::delete('/{table_id}/delete', [TableController::class, 'delete']);
    Route::get('/{table_id}/lista-pedidos', [OrderController::class, 'getAllPerTable']);

});

/**
 * CRUD do Cliente
 */
Route::prefix('/cliente')->group(function () {

    Route::get('/lista', [CustomerController::class, 'index']);
    Route::post('/cadastro', [CustomerController::class, 'create']);
    Route::get('/{customer_id}/show', [CustomerController::class, 'read']);
    Route::put('/{customer_id}/update',[CustomerController::class, 'update']);
    Route::delete('/{customer_id}/delete', [CustomerController::class, 'delete']);

});

/**
 * Métodos de Pedidos por Cliente
 */
Route::prefix('/cliente/{customer_id}')->group(function () {

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
Route::middleware(['auth:waiter'])->group(function () {
    Route::get('lista-pedidos',[OrderController::class, 'getAllPerEmployee']);
    Route::post('/{order_id}/adicionar-item/{iten_id}', [OrderController::class, 'addIten']);
    Route::get('lista-em-andamento', [OrderController::class, 'getAllOnGoing']);
    

    Route::post('/logout', [WaiterAuthController::class, 'logout']);
    Route::get('/me', [WaiterAuthController::class, 'me']);
    
});

// Rotas do Chef
Route::middleware(['auth:sanctum', 'type.chef'])->group(function () {
    Route::get('lista-pedidos',[OrderController::class, 'getAllPerEmployee']);
    Route::get('lista-em-andamento', [OrderController::class, 'getAllOnGoing']);
    Route::get('lista-a-fazer', [OrderController::class, 'getAllToDo']);
    Route::post('/{order_id}/iniciar-pedido', [OrderController::class, 'start']);
    Route::post('/{order_id}/finalizar-pedido', [OrderController::class, 'finish']);

    Route::post('/logout', [ChefAuthController::class, 'logout']);
    Route::get('/me', [ChefAuthController::class, 'me']);
    
});

Route::get('/', function(){

    return response()->json([
            'success' => true,
        ]);
});