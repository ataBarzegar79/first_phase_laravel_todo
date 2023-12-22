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
//todo: you have to always use names with your routes : https://laravel.com/docs/10.x/routing#named-routes
Route::get('/', function () {
    return view('task.form'); // todo : send the logic into controllers even if they are just 2 lines of code.
});

Route::get('register',[RegisterController::class,'create']);
Route::post('register',[RegisterController::class,'store']);

Route::get('login',[LogInController::class,'create']);
Route::post('login',[LogInController::class,'store']);
Route::post('logout',[LogInController::class,'dectory']); //  todo : if this controller also can log out user, why have you set a LogInController name to it ?
// todo : what is the meaning of dectory here ? you have to always use meaningful names.
Route::get('form',[TaskController::class,'create']); // todo : your names for your routes do not follow standards of a restful app !
Route::post('form',[TaskController::class,'store']); // todo : your names for your routes do not follow standards of a restful  app !

Route::get('index',[TaskController::class,'index']);
Route::get('/show/{task:id}',[TaskController::class,'show']);  // todo : in your routes , you don't need  / before first resource name it should be like  show/{task:id}.
// todo : you don' need id when working with task itself, you can just omit it : show/{task}   ----> https://laravel.com/docs/10.x/routing#route-model-binding:~:text=%7D)%3B-,Route%20Model%20Binding,-When%20injecting%20a
Route::get('/edit/{task}',[TaskController::class,'edit']); //todo : in your routes , you don't need  / before first resource name it should be like  show/{task:id}.
Route::patch('/edit/{task}',[TaskController::class,'update']);//todo : in your routes , you don't need  / before first resource name it should be like  show/{task:id}.

Route::delete('/delete/{task}',[TaskController::class,'delete']);//todo : in your routes , you don't need  / before first resource name it should be like  show/{task:id}.


// todo : define standard route names in your task resource, this resource may help you : https://laravel.com/docs/10.x/controllers#:~:text=Actions%20Handled%20By%20Resource%20Controller  ----> this can be an true example of route name choices
