<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }
    public function store(){
        $atterbutes = request()->validate([
            'name' => 'required|max:100|min:3',
            'email' => 'required|email|max:225',
            'password' => 'required|min:4'
        ]);
        User::create($atterbutes);
        return redirect('login');
    }
}
