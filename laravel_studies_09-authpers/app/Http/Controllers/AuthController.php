<?php

namespace App\Http\Controllers;

use App\Mail\NewUserConfirmation;
use App\Mail\ResetPassword;
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

    public function profile(): View
    {
        return view('auth.profile');
    }

    public function change_password(Request $request)
    {
        // form validation
        $request->validate(
            [
                'current_password' => 'required|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'new_password' => 'required|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|different:current_password',
                'new_password_confirmation' => 'required|same:new_password'
            ],
            [
                'current_password.required' => 'A senha atual é obrigatória.',
                'current_password.min' => 'A senha atual deve conter no mínimo :min caracteres.',
                'current_password.max' => 'A senha atual deve conter no máximo :max caracteres.',
                'current_password.regex' => 'A senha atual deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.',
                'new_password.required' => 'A nova senha é obrigatória.',
                'new_password.min' => 'A nova senha deve conter no mínimo :min caracteres.',
                'new_password.max' => 'A nova senha deve conter no máximo :max caracteres.',
                'new_password.regex' => 'A nova senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.',
                'new_password.different' => 'A nova senha deve ser diferente da senha atual.',
                'new_password_confirmation.required' => 'A confirmação da nova senha é obrigatória.',
                'new_password_confirmation.same' => 'A confirmação da nova senha deve ser igual à nova senha.',
            ]
        );

        //verificar se a senha atual está correta
        if (!password_verify($request->current_password, Auth::user()->password)) {
            return back()->with([
                'server_error' => 'A senha atual está incorreta.'
            ]);
        }

        //atualizar a senha no db
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        //atualizar a senha na sessao
        Auth::user()->password = $request->new_password;

        //mostrar mensagem de sucesso
        return redirect()->route('profile')->with([
            'success' => 'A senha foi atualizada com sucesso.'
        ]);
    }

    public function forgot_password(): View
    {
        return view('auth.forgot_password');
    }

    public function send_reset_password_link(Request $request)
    {
        //validacoes
        $request->validate(
            [
                'email' => ['required', 'email'],
            ],
            [
                'email.required' => 'O email é obrigatório',
                'email.email' => 'O email deve ser válido.',
            ]
        );

        $generic_message = "Verifique seu email para prosseguir com o processo de recuperação de senha.";

        //verificar se o email existe

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with([
                'server_message' => $generic_message
            ]);
        }

        //criar link com token para enviar ao email

        $user->token = Str::random(64);

        $token_link = route('reset_password', ['token' => $user->token]);

        //envio do email com link de recuperacao de senha
        $result = Mail::to($user->email)->send(new ResetPassword($user->username, $token_link));

        //verificar se o email foi enviado
        if (!$result) {
            return back()->with(['server_message' => $generic_message]);
        }

        //salva o token no db

        $user->save();

        return back()->with(['server_message' => $generic_message]);
    }

    public function reset_password($token): View | RedirectResponse
    {
        //verificar se o token é válido
        $user = User::where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login');
        }

        return view('auth.reset_password', ['token' => $token]);
    }

    public function reset_password_update(Request $request): RedirectResponse
    {
        //validação do form
        $request->validate(
            [
                'token' => 'required',
                'new_password' => 'required|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'new_password_confirmation' => 'required|same:new_password'
            ],
            [

                'new_password.required' => 'A nova senha é obrigatória.',
                'new_password.min' => 'A nova senha deve conter no mínimo :min caracteres.',
                'new_password.max' => 'A nova senha deve conter no máximo :max caracteres.',
                'new_password.regex' => 'A nova senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.',
                'new_password_confirmation.required' => 'A confirmação da nova senha é obrigatória.',
                'new_password_confirmation.same' => 'A confirmação da nova senha deve ser igual à nova senha'
            ]
        );

        //verifica se o token é válido

        $user = User::where('token', $request->token)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        //atualizar a senha no db

        $user->password = bcrypt($request->new_password);
        $user->token = null;
        $user->save();

        return redirect()->route('login')->with([
            'success' => true
        ]);
    }

    public function delete_account(Request $request)
    {
        // validação do form
        $request->validate(
            [
                'delete_confirmation' => ['required', 'in:APAGAR']
            ],
            [
                'delete_confirmation.required' => 'A confirmação é obrigatória',
                'delete_confirmation.in' => 'É obrigatório escrever a palavra APAGAR'
            ]
        );

        // remover a conta de usuario (hard delete ou soft delete)

        //soft delete

        $user = Auth::user();
        $user->delete();

        //hard delete

        // $user = Auth::user();
        // $user->forceDelete();

        // logout

        Auth::logout();

        // redirect login
        return redirect()->route('login')->with(['account_deleted' => true]);
    }
}
