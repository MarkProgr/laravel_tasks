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

Route::middleware('auth')->group(function () {
    Route::controller(LocalUserController::class)->group(function () {
        Route::get('/list', 'list')->name('main');
        Route::get('/create', 'createForm')->name('create.form');
        Route::post('/create', 'createUser')->name('create.user');
        Route::get('/edit/{localUser}', 'editForm')->name('edit.form');
        Route::post('/edit/{localUser}','editUser')->name('edit.user');
        Route::post('/delete/{localUser}', 'deleteUser')->name('delete.user');
        Route::get('/about/{localUser}', 'about')->name('about.user');
    });
});


Route::controller(UserController::class)->group(function () {
    Route::get('/sign-up','signUpForm')->name('sign-up.form');
    Route::post('/sign-up','signUp')->name('sign-up');
    Route::get('/login', 'loginForm')->name('login.form');
    Route::post('/login','login')->name('login');
    Route::post('/logout','logout')->name('logout');
});

//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
