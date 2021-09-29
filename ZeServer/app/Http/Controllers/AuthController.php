<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function register(Request $request){
        $field = $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email',
            'password' => 'confirmed'
        ]);
       $user =  User::create([
            'name' => $field['name'],
            'email' => $field['email'],
            'password' => bcrypt($field['password'])
        ]);

        return response([
            'message' => 'success',
            'user' => $user
        ]);
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response([
                'message' => 'Invalid credentials'
            ]);
        }

        $token = Auth::user()->createToken('appToken')->plainTextToken;
        return response([
            'message' => 'login successfull',
            'token' => $token
        ])->withCookie('jwt', $token, 60*24);
        
    }

    public function logout(Request $request){
        $cookie = Cookie::forget('jwt');
        return response([
            'message' => 'logged out'
        ])->withCookie($cookie);
    }

    
}
