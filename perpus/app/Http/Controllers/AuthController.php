<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:4'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Register success',
            'data' => $user
        ]);
    }

    function login(Request $request)
    {
        /**
         * 1. menangkap data request
         * 2. cari user berdasarkan email dari request
         * 3. bandingkan password request dengan password dari database
         * 4. jika password sama maka login berhasil
         */

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'login is invalid',
            ], 401);
        }

        if (Auth::attempt($request->all())) {
            $token = Auth::user()->createToken('authToken');

            return response()->json([
                'message' => 'Login success',
                'token' => $token->plainTextToken,
            ]);
        } else {
            return response()->json([
                'message' => 'login is invalid',
            ], 401);
        }
    }
}
