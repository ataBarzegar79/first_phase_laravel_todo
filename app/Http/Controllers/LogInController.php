<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogInRequest;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\RedirectResponse;
use  Illuminate\Support\Facades\Validator;

class LogInController extends Controller
{
    public function create()
    {
        return view('login.create');
    }

    public function store(StoreLogInRequest $request):RedirectResponse
    {

        $validator = $request->validated();

        if (! auth()->attempt($validator)) {
            return redirect()->route('login.create')
                ->withErrors($validator)
                ->withInput();
        }

        return redirect()->route('home');
        // todo : you have to separate your validations in the request classes :https://laravel.com/docs/10.x/validation#main-content:~:text=Form%20Request%20Validation-,Creating%20Form%20Requests,-For%20more%20complex
        // todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
         // todo : use translation files within your project to show a plain text: https://laravel.com/docs/10.x/localization#main-content
    }
}
