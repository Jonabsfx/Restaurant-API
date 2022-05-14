<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use App\Models\Chef;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ChefResource;

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

    public function me()
    {
        $chef = auth()->user();

        return new ChefResource($chef);
    }
}
