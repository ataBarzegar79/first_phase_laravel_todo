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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    Route::get('/dashboard/tasks/create', [TaskController::class, 'create'])->name('create');
    Route::post('/dashboard/tasks/create', [TaskController::class, 'store']);

    Route::get('/dashboard/tasks/manage', [TaskController::class, 'index'])->name('manage');

    Route::post('/dashboard/tasks/delete/{task:slug}', [TaskController::class, 'destroy'])->name('destroy');

    Route::get('/dashboard/tasks/update/{task:slug}', [TaskController::class, 'edit'])->name('update');
    Route::post('/dashboard/tasks/update/{task:slug}', [TaskController::class, 'update']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
