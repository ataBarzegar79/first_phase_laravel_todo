<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //todo : avoid unused import in your project !
//todo: your code isn't in the right format ----->  ctrl + alt + l
class LogInController extends Controller
{
    public function create(){
        return view('login.create');
    }
    public function store(){
        $atterbutes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); // todo : you have to separate your validations in the request classes :https://laravel.com/docs/10.x/validation#main-content:~:text=Form%20Request%20Validation-,Creating%20Form%20Requests,-For%20more%20complex
        if (auth()->attempt($atterbutes)) {
            session()->regenerate();
            return redirect('/')->with('success', 'Welcome Bake!'); // todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
        }
        return back()
            ->withInput()
            ->withErrors(['email' => 'Your provided credentials could not be verified.']); // todo : use translation files within your project to show a plain text: https://laravel.com/docs/10.x/localization#main-content
    }
    public function dectory(){ //todo : what is the meaning of dectory here ? you have to always use meaningful names.
        auth()->logout();
        return redirect('login')->with('success','Good Bye');// todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
    }
}
