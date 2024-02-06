<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::get('/', function ()
{
    return view('welcome');
})->name('laravel.homepage');

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function ()
{
    Route::get('/', function () {return view('dashboard');})->name('dashboard');

    Route::get('tasks/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('tasks/create', [TaskController::class, 'store'])->name('task.store');

    Route::get('tasks/manage', [TaskController::class, 'index'])->name('task.index');

    Route::post('tasks/delete/{task:id}', [TaskController::class, 'destroy'])->name('task.destroy');

    Route::get('update/{task:id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('tasks/update/{task:id}', [TaskController::class, 'update'])->name('task.update');
});

Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

