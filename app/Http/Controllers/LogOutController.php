<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogOutController extends Controller
{
    public function destroy(){ //todo : what is the meaning of dectory here ? you have to always use meaningful names.
        auth()->logout();
        return redirect('login/create')->with('success','Good Bye');// todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
    }
}
