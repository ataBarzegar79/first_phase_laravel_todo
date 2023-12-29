<?php

namespace App\Http\Controllers;

use http\Message;

class LogOutController extends Controller
{
    public function destroy() // todo : your login and logout is not implemented truly. install breeze in your project and compare its functionality within its controller.
    {
        auth()->logout();

        return redirect()->route('login.create')->with('success', __('message.logout'));
    }
}
