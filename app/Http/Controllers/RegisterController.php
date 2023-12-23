<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(StoreRegisterRequest $request)
    {
        $validator = $request->validated();

        User::create($validator);

        return redirect()->route('login.create');
    }
}
