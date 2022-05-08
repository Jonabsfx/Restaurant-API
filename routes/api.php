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
Route::get('/cardapios', [MenuController::class, 'index']);
Route::post('/criacao-menu', [MenuController::class, 'create']);
Route::get('/cardapio/{id_cardapio}', [MenuController::class, 'read']);
Route::put('/cardapio/{id_cardapio}',[MenuController::class, 'update']);
Route::delete('/cardapio/{id_cardapio]', [MenuController::class, 'delete']);

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