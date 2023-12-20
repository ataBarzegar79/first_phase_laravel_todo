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
        ]);
        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages(['email' => 'Your provided email or password incorrect. Please try logging in again.']);
        }
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome Back!');

    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'GoodBye!');
    }
}
