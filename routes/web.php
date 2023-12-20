<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])
    ->name('home');

Route::get('/login',[LoginController::class,'create'])
    ->name('login')
    ->middleware('guest');
Route::post('/login',[LoginController::class,'store'])
    ->middleware('guest');
Route::post('/logout',[LoginController::class,'destroy'])
    ->middleware('auth');

Route::get('/register',[RegisterController::class,'create'])
    ->name('register')
    ->middleware('guest');
Route::post('/register',[RegisterController::class,'store'])
    ->middleware('guest');

Route::resource('tasks',TaskController::class)
    ->middleware('auth');

//todo: 2(7+1) of your routes are using auth middleware try to collect them together :https://laravel.com/docs/10.x/routing#route-group-middleware
// todo : also do this for guest.

