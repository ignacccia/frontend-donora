<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
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
        $token = $request->bearerToken();

        if ($token) {
            // Verify token here and set user context if valid
            // This is a simplified example, adjust for your actual token verification logic
            try {
                // Assuming you're using JWT, you would decode the token here
                $user = Auth::guard('api')->user();
                if ($user) {
                    Auth::setUser($user);
                    return $next($request);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
