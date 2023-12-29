<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogInRequest;
use Illuminate\Http\RedirectResponse;

class LogInController extends Controller
{
    public function create()// todo : your login and logout is not implemented truly. install breeze in your project and compare its functionality within its controller.
    {
        return view('login.create');
    }

    public function store(StoreLogInRequest $request): RedirectResponse
    {

        $validator = $request->validated(); // todo : you don't need validation if it is passed as a parameter in your controller!
        if (!auth()->attempt($validator)) {
            return redirect()->route('login.create')
                ->withErrors($validator)
                ->withInput();
        }

        return redirect()->route('home')->with('success', __('message.login')); // todo :have forgotten s at the end of message !
    }
}
