<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    public function login(): RedirectResponse
    {
        $user = User::find(1);
        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function onlyAdmins()
    {
        if (Gate::allows('user_is_admin')) {
            echo 'bem vindo, admin';
        } else {
            echo 'erro: nao é um admin';
        }

        // outra maneira de ser feito:

        // if (Auth::user()->can('user_is_admin')) {
        //     echo 'bem vindo';
        // } else {
        //     echo 'user não é admin. saia';
        // }
    }

    public function onlyUsers()
    {
        if (Gate::allows('user_is_user')) {
            echo 'user é um usuário normal';
        } else {
            echo 'erro: você é um admin';
        }

        // outra maneira de ser feito:

        // if (Gate::denies('user_is_admin')) {
        //     echo 'o usuário logado é user normal.';
        // } else {
        //     echo 'esse usuário é um admin.';
        // }
    }
    
}
