<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'solicitudes' => App\Http\Middleware\InmobiliariaCors::class,
            'propiedadMidlw' => App\Http\Middleware\PropiedadesCors::class,
            'sesion' => App\Http\Middleware\SesionCors::class,
            'autenticacion' => App\Http\Middleware\ApiAuthMiddleware::class,
            'autenticacionWeb' => App\Http\Middleware\ApiWebMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            dd($e->getMessage());
        });
    })->create();
