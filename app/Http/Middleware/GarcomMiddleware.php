<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GarcomMiddleware
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
        if (auth()->user()->tokenCan('role:garcom')) {
            return $next($request);
        }

        return response()->json('Not Authorized', 401);

    }
}
