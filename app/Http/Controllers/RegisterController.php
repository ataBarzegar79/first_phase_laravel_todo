<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use function request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register/create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email'), 'max:255'],
            'password' => ['required', 'min:8', 'max:255'],
            'profile' => ['image']
        ]);
        $attributes['profile'] = request()->file('profile')->store('profiles');
        $user = User::create($attributes);
        auth()->login($user);
        return redirect('/')->with('success', 'Your account successfully created!');
    }
}
