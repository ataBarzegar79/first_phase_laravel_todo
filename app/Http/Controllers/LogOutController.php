<?php

namespace App\Http\Controllers;

use http\Message;

class LogOutController extends Controller
{
    public function destroy()
    { //todo : what is the meaning of dectory here ? you have to always use meaningful names.
        auth()->logout();

        return redirect()->route('login.create')->with('success', __('message.logout'));// todo: use named routes in your app : https://laravel.com/docs/10.x/controllers#main-content:~:text=return%20Redirect%3A%3Aroute(%27photos.index%27)
    }
}
