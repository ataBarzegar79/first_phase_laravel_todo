<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\LogOutController;
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
Route::get('/', [HomeController::class, 'create'])->name('home');

// todo: you haven't used appropriate middlewares in your code !.

Route::get('register/create', [RegisterController::class, 'create'])->name('register.create');
Route::post('register', [RegisterController::class, 'store'])->name('register');

Route::get('login/create', [LogInController::class, 'create'])->name('login.create');
Route::post('login', [LogInController::class, 'store'])->name('login');

Route::post('logout', [LogOutController::class, 'destroy'])->name('logout');

Route::get('tasks/create', [TaskController::class, 'create'])->name('task.create');
Route::post('tasks', [TaskController::class, 'store'])->name('task'); // todo : use consistent names for route names.

Route::get('tasks', [TaskController::class, 'index'])->name('task.index');
Route::get('tasks/{task}', [TaskController::class, 'show'])->name('task.show');

Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
Route::patch('tasks/{task}', [TaskController::class, 'update'])->name('task.update');

Route::delete('tasks/{task}', [TaskController::class, 'delete'])->name('delete'); // todo : use consistent names for route names.
// todo : tend to use resources in routes of laravel if it is suitable for your routes :


