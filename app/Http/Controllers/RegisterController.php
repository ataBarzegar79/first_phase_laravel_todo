<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; //todo : avoid unused import in your project !
//todo: your code isn't in the right format ----->  ctrl + alt + l

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }
    public function store(){
        $atterbutes = request()->validate([
            'name' => 'required|max:100|min:3',
            'email' => 'required|email|max:225',
            'password' => 'required|min:4'
        ]);// todo : you have to separate your validations in the request classes :https://laravel.com/docs/10.x/validation#main-content:~:text=Form%20Request%20Validation-,Creating%20Form%20Requests,-For%20more%20complex
        User::create($atterbutes);
        return redirect('login/create'); // todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
    }
}
