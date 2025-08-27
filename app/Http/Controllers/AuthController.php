<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);
        if($request->password == '123456') {
            return redirect()->route('home');
        }
        else{
            return redirect()->back()->with('error', 'Invalid Password');
        }

    }
}
