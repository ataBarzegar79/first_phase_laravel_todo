<?php

use App\Http\Controllers\LogInController;
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

Route::get('/', function () {
    return view('task.form');
});

Route::get('register',[RegisterController::class,'create']);
Route::post('register',[RegisterController::class,'store']);

Route::get('login',[LogInController::class,'create']);
Route::post('login',[LogInController::class,'store']);
Route::post('logout',[LogInController::class,'dectory']);

Route::get('form',[TaskController::class,'create']);
Route::post('form',[TaskController::class,'store']);

Route::get('index',[TaskController::class,'index']);
Route::get('/show/{task:id}',[TaskController::class,'show']);

Route::get('/edit/{task}',[TaskController::class,'edit']);
Route::patch('/edit/{task}',[TaskController::class,'update']);

Route::delete('/delete/{task}',[TaskController::class,'delete']);
