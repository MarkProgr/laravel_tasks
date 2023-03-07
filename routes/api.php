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

Route::post('/products', [\DDD\Product\Application\ProductController::class, 'addProduct']);
Route::get('/products/{product}', [ProductController::class, 'about']);
Route::get('/products', [\DDD\Product\Application\ProductController::class, 'showProducts']);
Route::delete('/products/{product}', [\DDD\Product\Application\ProductController::class, 'deleteProduct']);
Route::put('/products/{product}', [\DDD\Product\Application\ProductController::class, 'updateProduct']);
Route::post('/products/filter', [ProductController::class, 'filterByCategory']);

Route::get('/categories/{category}', [CategoryController::class, 'about']);
Route::get('/categories', [CategoryController::class, 'list']);
Route::post('/categories', [CategoryController::class, 'create']);
Route::delete('/categories/{category}', [CategoryController::class, 'delete']);
Route::put('/categories/{category}', [CategoryController::class, 'update']);

Route::get('/about/{user}', [LocalUserController::class, 'about']);

Route::put('/edit/{user}', [LocalUserController::class, 'edit']);

Route::delete('/delete/{user}', [LocalUserController::class, 'delete']);

Route::post('/create', [LocalUserController::class, 'create']);

Route::get('/', [LocalUserController::class, 'list']);

Route::controller(MessageController::class)->group(function () {
    Route::get('/messages', 'index');
    Route::post('/messages', 'send');
});
