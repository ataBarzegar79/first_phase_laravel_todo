<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Validation\Rule;
use function request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(StoreRegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['profile'] = request()->file('profile')->store('profiles');
        $user = User::create($validated);
        auth()->login($user);
        return redirect()->route('home')->with('success', __('messages.create'));
    }
}
