<?php

namespace App\Http\Controllers;

use App\Services\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //validar o request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //tentativa de login
        $email = $request->email;
        $password = $request->password;
        $attempt = auth()->attempt([
            'email' => $email,
            'password' => $password
        ]);

        if (!$attempt) {
            return ApiResponse::unauthorized();
        }

        //autenticar o usuário
        $user = auth()->user();
        $token = $user->createToken($user->name)->plainTextToken;

        //retornar o token de acesso para a api
        return ApiResponse::success(
            [
                'user' => $user->name,
                'email' => $user->email,
                'token' => $token
            ]
        );
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return ApiResponse::success('Logout feito com sucesso.');
    }
}
