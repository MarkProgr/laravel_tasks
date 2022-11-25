<?php

use App\Http\Controllers\LocalUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LocalUserController::class, 'list'])->name('main')
    ->middleware('auth');;

Route::get('/create', [LocalUserController::class, 'createForm'])->name('create.form')
    ->middleware('auth');
Route::post('/create', [LocalUserController::class, 'create'])->name('create.user')
    ->middleware('auth');

Route::get('/edit/{localUser}', [LocalUserController::class, 'editForm'])->name('edit.form')
    ->middleware('auth');
Route::post('/edit/{localUser}', [LocalUserController::class, 'edit'])->name('edit.user')
    ->middleware('auth');

Route::post('/delete/{localUser}', [LocalUserController::class, 'delete'])->name('delete.user')
    ->middleware('auth');;

Route::get('/about/{localUser}', [LocalUserController::class, 'about'])->name('about.user')
    ->middleware('auth');;

Route::get('/sign-up', [UserController::class, 'signUpForm'])->name('sign-up.form');
Route::post('/sign-up', [UserController::class, 'signUp'])->name('sign-up');

Route::get('/login', [UserController::class, 'loginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
