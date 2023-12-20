<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use function request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email'), 'max:255'], //todo : you can use this to assess uniqueness of emails  : https://laravel.com/docs/10.x/validation#rule-unique
            'password' => ['required', 'min:8', 'max:255'],
            'profile' => ['image']
        ]); // todo : transfer your validations into seperated Request files which are Documented in Laravel : https://laravel.com/docs/10.x/validation#creating-form-requests
        $attributes['profile'] = request()->file('profile')->store('profiles');
        $user = User::create($attributes);
        auth()->login($user);
        return redirect('/')->with('success', 'Your account successfully created!'); //todo: please try to always use named routes in your redirects : https://laravel.com/docs/10.x/redirects#redirecting-named-routes
    }
}
