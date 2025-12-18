<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        dd($request);
        $request->validate([
            'email' => 'required |email |exists:users,email '  ,
            'password' => 'required',
        ]);
        $user = User::where('email' , '=' , $request->email)->first();
        if(Hash::check($request->password, $user->password))
        {
            $token = $user->createToken($user->email)->AccessToken;
            return redirect()->route('test');
        }
        else{
            return redirect()->back()->with(['password' => 'wrong email or password']);
        }
    }
}
