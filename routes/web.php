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
        Route::get('/', 'list')->name('main');
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



//Route::get('/', [LocalUserController::class, 'list'])->name('main')
//    ->middleware('auth');;

//Route::get('/create', [LocalUserController::class, 'createForm'])->name('create.form')
//    ->middleware('auth');
//Route::post('/create', [LocalUserController::class, 'createUser'])->name('create.user')
//    ->middleware('auth');

//Route::get('/edit/{localUser}', [LocalUserController::class, 'editForm'])->name('edit.form')
//    ->middleware('auth');
//Route::post('/edit/{localUser}', [LocalUserController::class, 'editUser'])->name('edit.user')
//    ->middleware('auth');
//
//Route::post('/delete/{localUser}', [LocalUserController::class, 'deleteUser'])->name('delete.user')
//    ->middleware('auth');;
//
//Route::get('/about/{localUser}', [LocalUserController::class, 'about'])->name('about.user')
//    ->middleware('auth');;

//Route::get('/sign-up', [UserController::class, 'signUpForm'])->name('sign-up.form');
//Route::post('/sign-up', [UserController::class, 'signUp'])->name('sign-up');
//
//Route::get('/login', [UserController::class, 'loginForm'])->name('login.form');
//Route::post('/login', [UserController::class, 'login'])->name('login');
//Route::post('/logout', [UserController::class, 'logout'])->name('logout');


