<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\IndexController;
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
    ->group(function () {
        Route::get('/', IndexController::class)
            ->name('prezet.index');

        Route::get('/articles', ArticleController::class);

        Route::get('/about', function () {
            return view('about');
        });

        Route::get('/projects', function () {
            return view('projects');
        });

        Route::get('/uses', function () {
            return view('uses');
        });
    });

require __DIR__.'/prezet.php';
