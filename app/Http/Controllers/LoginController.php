<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('login.create');
    }

    public function store(StoreLoginRequest $request)
    {
        $validated = $request->validated();
        if (!auth()->attempt($validated)) {
            throw ValidationException::withMessages(['email' => __('auth.email')]);
        }
        session()->regenerate();
        return redirect()->route('home')->with('success', __('messages.welcome'));
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'GoodBye!');
    }
}
