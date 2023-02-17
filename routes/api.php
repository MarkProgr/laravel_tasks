<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LocalUserController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ProductController;
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

Route::post('/product/create', [ProductController::class, 'create']);
Route::get('/product/{product}', [ProductController::class, 'about']);
Route::get('/product/', [ProductController::class, 'list']);
Route::delete('/product/{product}', [ProductController::class, 'delete']);
Route::put('/product/{product}', [ProductController::class, 'update']);
Route::post('/product/filter', [ProductController::class, 'filterByCategory']);

Route::get('/category/{category}', [CategoryController::class, 'about']);
Route::get('/category/', [CategoryController::class, 'list']);
Route::post('/category/create', [CategoryController::class, 'create']);
Route::delete('/category/{category}', [CategoryController::class, 'delete']);
Route::put('/category/{category}', [CategoryController::class, 'update']);

Route::get('/about/{user}', [LocalUserController::class, 'about']);

Route::put('/edit/{user}', [LocalUserController::class, 'edit']);

Route::delete('/delete/{user}', [LocalUserController::class, 'delete']);

Route::post('/create', [LocalUserController::class, 'create']);

Route::get('/', [LocalUserController::class, 'list']);

Route::controller(MessageController::class)->group(function () {
    Route::get('/messages', 'index');
    Route::post('/messages', 'send');
});
