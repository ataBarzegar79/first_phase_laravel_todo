<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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


Route::get('/', [HomeController::class, 'create'])
    ->name('home');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [TaskController::class, 'create'])
        ->name('dashboard');
    Route::post('tasks', [TaskController::class, 'store'])
        ->name('task.store');

    Route::get('tasks', [TaskController::class, 'index'])
        ->name('task.index');
    Route::get('tasks/{task}', [TaskController::class, 'show'])
        ->name('task.show');

    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])
        ->name('task.edit');
    Route::patch('tasks/{task}', [TaskController::class, 'update'])
        ->name('task.update');

    Route::delete('tasks/{task}', [TaskController::class, 'delete'])
        ->name('task.delete');
}); // todo : it is recommended to use resources if you are using all available rotes : https://laravel.com/docs/10.x/controllers#resource-controllers

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
