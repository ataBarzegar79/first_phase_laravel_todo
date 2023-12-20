<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogInController extends Controller
{
    public function create(){
        return view('login.create');
    }
    public function store(){
        $atterbutes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt($atterbutes)) {
            session()->regenerate();
            return redirect('/')->with('success', 'Welcome Bake!');
        }
        return back()
            ->withInput()
            ->withErrors(['email' => 'Your provided credentials could not be verified.']);
    }
    public function dectory(){
        auth()->logout();
        return redirect('login')->with('success','Good Bye');
    }
}
