<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PortfolioContentController;
use App\Http\Controllers\PortfolioImageController;
use App\Http\Middleware\EnsureAdminUser;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/admin', 'welcome')->name('admin');

Route::prefix('api')->group(function () {
    Route::get('/portfolio', [PortfolioContentController::class, 'show']);
    Route::get('/admin/session', [AdminAuthController::class, 'session']);
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->middleware('throttle:admin-login');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->middleware(EnsureAdminUser::class);
    Route::post('/contact', [ContactMessageController::class, 'store'])->middleware('throttle:10,1');

    Route::middleware(EnsureAdminUser::class)->prefix('admin')->group(function () {
        Route::put('/portfolio', [PortfolioContentController::class, 'update']);
        Route::post('/presence', [AdminAuthController::class, 'presence'])->middleware('throttle:30,1');
        Route::post('/images', [PortfolioImageController::class, 'store'])->middleware('throttle:30,1');
        Route::get('/messages', [ContactMessageController::class, 'index']);
        Route::patch('/messages/{contactMessage}/read', [ContactMessageController::class, 'markRead']);
        Route::delete('/messages/{contactMessage}', [ContactMessageController::class, 'destroy']);
    });
});
