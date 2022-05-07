<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CozinheiroMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->tokenCan('role:cozinheiro')) {
            return $next($request);
        }

        return response()->json('Not Authorized', 401);

    }
}
