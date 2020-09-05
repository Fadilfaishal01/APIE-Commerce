<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $name       = $request->input('name');
        $email      = $request->input('email');
        $password   = Hash::make($request->input('password'));

        $register = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        if($register) {
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Ditambahkan',
                'data'    => $register
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Ditambahkan',
                'data'    => ''
            ], 400);
        }
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if(Hash::check($password, $user->password))
        {
            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'data'    => [
                    'user' => $user
                ]
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Login Gaga',
                'data'    => ['user' => '']
            ], 400);
        }
    }
}
