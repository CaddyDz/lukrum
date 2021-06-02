<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Auth;

class IsInternalAdminMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $message = "You are not authorized for this action.";
        if (Auth::user()->isInternalAdmin()) {
            return $next($request);
        }

        return response()->json([
            'status' => 0,
            'success' => false,
            'message' => $message
        ], 401);
    }
}
