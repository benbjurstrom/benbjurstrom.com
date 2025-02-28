<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\IndexController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

Route::withoutMiddleware([
        ShareErrorsFromSession::class,
        StartSession::class,
        ValidateCsrfToken::class,
    ])
    ->middleware('cache.headers:s_maxage=86400')
    ->group(function () {
        Route::get('/', IndexController::class)
            ->name('prezet.index');

        Route::get('/articles', ArticleController::class)
            ->name('articles');

        Route::get('/about', function () {
            return view('about');
        })->name('about');

        Route::get('/projects', function () {
            return view('projects');
        })->name('projects');

        Route::get('/uses', function () {
            return view('uses');
        })->name('uses');
    });

require __DIR__.'/prezet.php';
