<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class TokenExpirationMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {
            $token = $user->currentAccessToken();

            if ($token && $token->expires_at) {
                // Convert expires_at to Carbon instance
                $expiresAt = Carbon::parse($token->expires_at);

                if (Carbon::now()->greaterThan($expiresAt)) {
                    // Token is expired, delete it
                    $token->delete();

                    return response()->json([
                        'message' => 'Token expired. Please log in again.'
                    ], 401);
                }
            }
        }

        return $next($request);
    }
}
