<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create()
    {
        return view();
    }
    public function store()
    {

    }
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'GoodBye!');
    }
}
