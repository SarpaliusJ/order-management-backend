<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderController;
use App\Http\Middleware\JWTAuthentication;
use Illuminate\Support\Facades\Route;

Route::middleware([JWTAuthentication::class])->group(function () {
    Route::controller(OrderController::class)->group(function () {
        Route::prefix('order')->group(function () {
            Route::get('/', 'index');
            Route::post('/create', 'create');
            Route::get('/{order}', 'show');
            Route::post('/update/{order}', 'update');
            Route::delete('/{order}', 'delete');
        });
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});
