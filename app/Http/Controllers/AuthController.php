<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => 'required',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if (Hash::check($request->password, $user->password)) {
            // $token = $user->createToken($user->email)->AccessToken;
            Auth::login($user);
            if ($user->role == 'admin') {
                return redirect()->to('/admin');
            }
            return redirect()->route('chat');
        } else {
            return redirect()->back()->withErrors(['password' => 'wrong email or password'])->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('loginPage');

    }
}
