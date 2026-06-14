<?php

use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CorsMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(CorsMiddleware::class);
        $middleware->alias([
            'role' => CheckRole::class,
        ]);

        $middleware->api(prepend: [
            EnsureFrontendRequestsAreStateful::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'api/*',  // استثناء جميع مسارات API من CSRF
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
