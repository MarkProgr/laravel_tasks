<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LocalUserController;
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

//Route::middleware('')->group(function () {
//    Route::controller(ProductController::class)->group(function () {
//        Route::post('/api/product/create', 'create');
//        Route::get('/api/product/about/{product}', 'about');
//        Route::get('/api/product/list', 'list');
//        Route::delete('/api/product/delete/{product}', 'delete');
//        Route::put('/api/product/edit/{product}', 'update');
//        Route::post('/api/product/filter', 'filterByCategory');
//    });
//});

Route::post('/product/create', [ProductController::class, 'create']);
Route::get('/product/about/{product}', [ProductController::class, 'about']);
Route::get('/product/list', [ProductController::class, 'list']);
Route::delete('/product/delete/{product}', [ProductController::class, 'delete']);
Route::put('/product/edit/{product}', [ProductController::class, 'update']);
Route::post('/product/filter', [ProductController::class, 'filterByCategory']);

Route::get('/category/about/{category}', [CategoryController::class, 'about']);
Route::get('/category/list', [CategoryController::class, 'list']);
Route::post('/category/create', [CategoryController::class, 'create']);
Route::delete('/category/delete/{category}', [CategoryController::class, 'delete']);
Route::put('/category/edit/{category}', [CategoryController::class, 'update']);

Route::get('/about/{user}', [LocalUserController::class, 'about']);

Route::put('/edit/{user}', [LocalUserController::class, 'edit']);

Route::delete('/delete/{user}', [LocalUserController::class, 'delete']);

Route::post('/create', [LocalUserController::class, 'create']);

Route::get('/list', [LocalUserController::class, 'list']);
