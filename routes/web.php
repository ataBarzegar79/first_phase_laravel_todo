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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', function () {return view('dashboard');})->name('dashboard');

    Route::get('tasks/create', [TaskController::class, 'create'])->name('create');
    Route::post('tasks/create', [TaskController::class, 'store'])->name('store');

    Route::get('tasks/manage', [TaskController::class, 'index'])->name('manage'); // todo : you haven't chosen a suitable name for your route, this can be a good example : https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controllers:~:text=Actions%20Handled%20by%20Resource%20Controllers
    Route::post('tasks/delete/{task:slug}', [TaskController::class, 'destroy'])->name('destroy'); // todo : use ids where as possible + your naming isn't standard :   https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controllers:~:text=Actions%20Handled%20by%20Resource%20Controllers
    Route::get('update/{task:slug}', [TaskController::class, 'edit'])->name('edit');// todo : you haven't chosen a suitable name for your route, this can be a good example : https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controllers:~:text=Actions%20Handled%20by%20Resource%20Controllers
    Route::post('tasks/update/{task:slug}', [TaskController::class, 'update'])->name('update'); // todo : you haven't chosen a suitable name for your route, this can be a good example : https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controllers:~:text=Actions%20Handled%20by%20Resource%20Controllers
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

