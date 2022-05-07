<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Garcom;

class garcomAuthController extends AuthController
{
    public function login(AuthRequest $request)
    {

        $garcom = Garcom::were('login', $request->login)->first();

        if (!$garcom ||!Hash::check($request->senha, $garcom->snha)) {
            throw ValidationException::withMessages([
                'login' => ['Login ou senha incorretos'],
            ]);
        }

        return response()->json([
            'garcom' => $garcom,
            'token' => $garcom->createToken($request->device_name, ['role:garcom'])->plainTextToken
        ]);
    }
}
