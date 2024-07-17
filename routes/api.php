<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
    Route::get('/categories/{category}/products', [CategoryController::class, 'products']);
    Route::apiResource('products', ProductController::class)->only(['index', 'show']);

    Route::post('register',[AuthController::class, 'register']);
    Route::post('login',[AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout',[AuthController::class, 'logout']);
        Route::get('user',[AuthController::class, 'user']);

        Route::apiResource('categories', CategoryController::class)->except(['index', 'show', 'products']);
        Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    });
});
