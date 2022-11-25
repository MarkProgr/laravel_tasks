<?php

use App\Http\Controllers\Api\LocalUserController;
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

Route::get('/api/about/{localUser}', [LocalUserController::class, 'about']);

Route::put('/api/edit/{localUser}', [LocalUserController::class, 'edit']);

Route::delete('/api/delete/{localUser}', [LocalUserController::class, 'delete']);

Route::post('/api/create', [LocalUserController::class, 'create']);

Route::get('/api/list', [LocalUserController::class, 'list']);
