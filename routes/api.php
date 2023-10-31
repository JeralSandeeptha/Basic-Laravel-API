<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('product', [ProductController::class, 'addProduct']);
// Route::get('product', [ProductController::class, 'getProducts']);
// Route::get('product/{productId}', [ProductController::class, 'getProduct']);
// Route::put('product/{productId}', [ProductController::class, 'updateProduct']);
// Route::delete('product/{productId}', [ProductController::class, 'deleteProduct']);

Route::middleware('api')->prefix('products')->group(function () {
    Route::post('/', [ProductController::class, 'addProduct']);
    Route::get('/', [ProductController::class, 'getProducts']);
    Route::get('/{productId}', [ProductController::class, 'getProduct']);
    Route::put('/{productId}', [ProductController::class, 'updateProduct']);
    Route::delete('/{productId}', [ProductController::class, 'deleteProduct']);
});