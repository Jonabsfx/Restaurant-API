<?php


use App\Http\Controllers\Api\Auth\{
    AuthController,
    ResetPasswordController
};
use Illuminate\Support\Facades\Route;


/**
 * Autenticação
 */
Route::post('/login-garcom', [GarcomAuthController::class, 'login']);
Route::post('/login-cozinheiro', [CozinheiroAuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

/**
 * Resetar a Senha
 */
Route::post('/esqueci-senha', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/resetar-senha', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');


// Rotas do Garçcom
Route::middleware(['auth:sanctum', 'type.garcom'])->group(function () {
    
});

// Rotas do Cozinheiro
Route::middleware(['auth:sanctum', 'type.cozinheiro'])->group(function () {
    
});

Route::get('/', function(){

    return response()->json([
            'success' => true,
        ]);
});