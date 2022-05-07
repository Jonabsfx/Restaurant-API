<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cozinheiro;

class CozinheiroAuthController extends AuthController
{
    public function login(AuthRequest $request)
    {

        $cozinheiro = Cozinheiro::were('login', $request->login)->first();

        if (!$cozinheiro ||!Hash::check($request->senha, $cozinheiro->snha)) {
            throw ValidationException::withMessages([
                'login' => ['Login ou senha incorretos'],
            ]);
        }

        return response()->json([
            'cozinheiro' => $cozinheiro,
            'token' => $cozinheiro->createToken($request->device_name, ['role:cozinheiro'])->plainTextToken
        ]);
    }
}
