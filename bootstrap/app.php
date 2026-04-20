<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureFreelancerVerified;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
         api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
     ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'freelancer.verified' => EnsureFreelancerVerified::class,
            'client.only' => \App\Http\Middleware\ClientOnly::class,
            'freelancer.only' => \App\Http\Middleware\FreelancerOnly::class,
        ]);

    })
    
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
    


