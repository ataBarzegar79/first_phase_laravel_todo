<?php

namespace App\Http\Controllers;

use http\Message;

class LogOutController extends Controller
{
    public function destroy()
    {
        auth()->logout();

        return redirect()->route('login.create')->with('success', __('message.logout'));
    }
}
