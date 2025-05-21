<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Spatie\Cors\HandleCors; // CORS Middleware

class Kernel extends HttpKernel
{
    /**
     * The application's middleware stack.
     *
     * This is run during every HTTP request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // Global middleware
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'token.expiry' => \App\Http\Middleware\TokenExpirationMiddleware::class,
        // other route-specific middlewares
    ];

    /**
     * The application's middleware groups.
     *
     * These groups are assigned to routes based on their type (API, web, etc.).
     *
     * @var array
     */
    protected $middlewareGroups = [
        'api' => [
            HandleCors::class, // CORS Middleware for API
            SubstituteBindings::class,
            StartSession::class,
            'throttle:api', // Example throttle middleware
        ],

        'web' => [
            // Web middleware
        ],
    ];
}
