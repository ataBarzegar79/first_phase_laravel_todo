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
        // todo : you have to separate your validations in the request classes :https://laravel.com/docs/10.x/validation#main-content:~:text=Form%20Request%20Validation-,Creating%20Form%20Requests,-For%20more%20complex
        User::create($validator);
        return redirect()->route('login.create'); // todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
    }
}
