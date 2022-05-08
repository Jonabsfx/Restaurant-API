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
 * Métodos de Pedidos por CLiente
 */
Route::prefix('/cliente/{id_cliente}')->group(function () {

    Route::get('/maior-pedido', [OrderController::class, 'getBiggestOrder']);
    Route::get('/menor-pedido', [OrderController::class, 'getLowestOrder']);
    Route::get('/primeiro-pedido', [OrderController::class, 'getFirstOrder']);
    Route::get('/ultimo-pedido', [OrderController::class, 'getLastOrder']);
    Route::get('/lista-pedidos', [OrderController::class, 'getAllClientOrders']);

});


// Rotas do Garçcom
Route::middleware(['auth:sanctum', 'type.waiter'])->group(function () {
    
});

// Rotas do Chef
Route::middleware(['auth:sanctum', 'type.chef'])->group(function () {
    
});

Route::get('/', function(){

    return response()->json([
            'success' => true,
        ]);
});