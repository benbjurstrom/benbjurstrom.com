<?php

use BenBjurstrom\Prezet\Http\Controllers\ImageController;
use BenBjurstrom\Prezet\Http\Controllers\OgimageController;
use BenBjurstrom\Prezet\Http\Controllers\ShowController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

Route::middleware('cache.headers:public;max_age=7200;etag')
    // Cloudflare free plan: Minimum Edge Cache TTL 2 hours
    ->withoutMiddleware([
        ShareErrorsFromSession::class,
        StartSession::class,
        ValidateCsrfToken::class,
    ])
    ->middleware('cache.headers:s_maxage=86400')
    ->group(function () {
        Route::get('prezet/img/{path}', ImageController::class)
            ->name('prezet.image')
            ->where('path', '.*');

        Route::get('/prezet/ogimage/{slug}', OgimageController::class)
            ->name('prezet.ogimage')
            ->where('slug', '.*');

        Route::get('/{slug}', ShowController::class)
            ->name('prezet.show')
            ->where('slug', '.*');
        // https://laravel.com/docs/11.x/routing#parameters-encoded-forward-slashes
    });
