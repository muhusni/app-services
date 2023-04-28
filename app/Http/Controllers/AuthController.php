<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            $token = Auth::user()->createToken('token');

            return $token->plainTextToken;
            // return redirect()->intended('dashboard');
        }

        return response()->json([
            'email' => 'The provided credentials do not match our records.',
        ], 401);
    }

    public function me()
    {
        $data = auth()->user();
        return $data;
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
    }
}
