<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        if ($request->input('username') == 'admin'&&$request->input('password') == 'admin') {
            $request->session()->put('authenticated', time());
            return redirect()->route('logfile');
        }

        return view('login', [
            'message' => 'Provided username and password is invalid. ',
        ]);
    }

}
