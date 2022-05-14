<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Waiter;
use App\Http\Resources\WaiterResource;

class WaiterAuthController extends AuthController
{
    public function login(AuthRequest $request)
    {
        $waiter = Waiter::select('*')
                            ->where('login', $request->login)
                            ->first();

        if (!$waiter ||$request->password != $waiter->password) {
            throw ValidationException::withMessages([
                'login' => ['Login ou password incorretos'],
            ]);
        }

        return response()->json([
            'waiter' => $waiter,
            'token' => $waiter->createToken($request->device_name, ['role:waiter'])->plainTextToken
        ]);
    }

    public function me()
    {
        $waiter = auth()->user();

        return new WaiterResource($waiter);
    }

}
