<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// v1 routes
Route::prefix('v1')->group(function () {

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductsController::class, 'index']);
    });

});
