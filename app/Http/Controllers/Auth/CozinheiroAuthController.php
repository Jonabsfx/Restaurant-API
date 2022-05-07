<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chef;

class ChefAuthController extends AuthController
{
    public function login(AuthRequest $request)
    {

        $chef = Chef::were('login', $request->login)->first();

        if (!$chef ||!Hash::check($request->password, $chef->snha)) {
            throw ValidationException::withMessages([
                'login' => ['Login ou password incorretos'],
            ]);
        }

        return response()->json([
            'chef' => $chef,
            'token' => $chef->createToken($request->device_name, ['role:chef'])->plainTextToken
        ]);
    }
}
