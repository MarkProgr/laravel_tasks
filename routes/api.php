<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::post('/api/api/create/product', 'create');
        Route::get('/api/api/about/product/{product}', 'about');
        Route::get('/api/api/list/products', 'list');
        Route::delete('/api/api/delete/product/{product}', 'delete');
        Route::put('/api/api/edit/product/{product}', 'update');
        Route::post('/api/api/filter/product', 'filterByCategory');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/api/api/about/category/{category}', 'about');
        Route::get('/api/api/list/categories', 'list');
        Route::post('/api/api/create/category', 'create');
        Route::delete('/api/api/delete/category/{category}', 'delete');
        Route::put('/api/api/edit/category/{category}', 'update');
    });
});
