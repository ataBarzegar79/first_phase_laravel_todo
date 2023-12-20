<?php

namespace App\Http\Controllers;


use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use function request;

class LoginController extends Controller
{
    public function create()
    {
        return view('login.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]); // todo : transfer your validations into seperated Request files which are Documented in Laravel : https://laravel.com/docs/10.x/validation#creating-form-requests
        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages(['email' => 'Your provided email or password incorrect. Please try logging in again.']); //todo: for any message which will be showed to user you should use translation files! : https://laravel.com/docs/10.x/localization
        }
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome Back!'); //todo: please try to always use named routes in your redirects : https://laravel.com/docs/10.x/redirects#redirecting-named-routes
        //todo: for any message which will be showed to user you should use translation files! : https://laravel.com/docs/10.x/localization
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'GoodBye!');
    }
}
