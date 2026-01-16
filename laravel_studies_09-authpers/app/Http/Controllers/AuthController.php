<?php

namespace App\Http\Controllers;

use App\Mail\NewUserConfirmation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;

use function Symfony\Component\Clock\now;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // validacao do form
        $credentials = $request->validate(
            [
                'username' => 'required|min:3|max:30',
                'password' => 'required|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/'
            ],
            [
                'username.required' => 'O usuário é obrigatório',
                'username.min' => 'O usuário deve ter no mínimo :min carecteres',
                'username.max' => 'O usuário deve ter no maximo :max carecteres',
                'password.required' => 'O campo senha é obrigatório.',
                'password.min' => 'A senha deve ter no mínimo :min caracteres.',
                'password.max' => 'A senha deve ter no máximo :max caracteres.',
                'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.',
            ]
        );

        //login tradicional do laravel

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->route('home');
        // } // usar se tem email e password

        //verificar se o user existe
        $user = User::where('username', $credentials['username'])
            ->where('active', true)
            ->where(function ($query) {
                $query->whereNull('blocked_until')
                    ->orWhere('blocked_until', '<=', now());
            })
            ->whereNotNull('email_verified_at')
            ->whereNull('deleted_at')
            ->first();

        // verifica se o user existe
        if (!$user) {
            return back()->withInput()->with([
                'invalid_login' => 'Login inválido.'
            ]);
        }

        // verificar se a password é válida
        if (!password_verify($credentials['password'], $user->password)) {
            return back()->withInput()->with([
                'invalid_login' => 'Login inválido.'
            ]);
        }

        // atualizar o ultimo login
        $user->last_login_at = now();
        $user->blocked_until = null;
        $user->save();

        // login
        $request->session()->regenerate();
        Auth::login($user);

        // redirecionar
        return redirect()->intended(route('home'));
    }

    public function logout(): RedirectResponse
    {
        // logout
        Auth::logout();
        return redirect()->route('login');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function store_user(Request $request): RedirectResponse | View
    {
        // validacao do form
        $request->validate(
            [
                'username' => 'required|min:3|max:30|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'username.required' => 'O usuário é obrigatório.',
                'username.min'      => 'O usuário deve ter no mínimo :min caracteres.',
                'username.max'      => 'O usuário deve ter no máximo :max caracteres.',
                'username.unique'   => 'Este usuário já está em uso.',

                // EMAIL
                'email.required' => 'O e-mail é obrigatório.',
                'email.email'    => 'Informe um endereço de e-mail válido.',
                'email.unique'   => 'Este e-mail já está cadastrado.',

                // PASSWORD
                'password.required' => 'A senha é obrigatória.',
                'password.min'      => 'A senha deve ter no mínimo :min caracteres.',
                'password.max'      => 'A senha deve ter no máximo :max caracteres.',
                'password.regex'    => 'A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.',

                // PASSWORD CONFIRMATION
                'password_confirmation.required' => 'A confirmação da senha é obrigatória.',
                'password_confirmation.same'     => 'As senhas nao sao iguais.',
            ]
        );

        // criar novo user com verificacao de email
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->token = Str::random(64);

        // gerar link
        $confirmation_link = route('new_user_confirmation', ['token' => $user->token]);

        // enviar email
        $result = Mail::to($user->email)->send(new NewUserConfirmation($user->username, $confirmation_link));

        // verificar se o email foi enviado

        if (!$result) {
            return back()->withInput()->with([
                'server_error' => 'Ocorreu um erro ao enviar o email de confirmação.'
            ]);
        }

        //criar o usuario

        $user->save();

        //view de sucesso

        return view('auth.email_sent', ['email' => $user->email]);
    }

    public function new_user_confirmation($token)
    {
        // verificar se o token é válido

        $user = User::where('token', $token)
            ->first();

        if (!$user) {
            return redirect()->route('login');
        }

        //confirmar o registro do usuario

        $user->email_verified_at = Carbon::now();
        $user->token = null;
        $user->active = true;
        $user->save();

        //login automatico do usuario confirmado

        Auth::login($user);

        // mensagem de sucesso
        return view('auth.new_user_confirmation');
    }
}
