<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogInRequest;
use Illuminate\Http\RedirectResponse;

class LogInController extends Controller
{
    public function create()
    {
        return view('login.create');
    }

    public function store(StoreLogInRequest $request): RedirectResponse
    {

        $validator = $request->validated();

        if (!auth()->attempt($validator)) {
            return redirect()->route('login.create')
                ->withErrors($validator)
                ->withInput();
        }

        return redirect()->route('home')->with('success', __('message.login'));
    }
}
