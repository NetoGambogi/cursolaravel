<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_user($id)
    {
        // $user = User::find($id);
        // Auth::login($user);
        // return redirect()->route('home');

        $user = User::with('permissions')->find($id);
        Auth::login($user);
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
