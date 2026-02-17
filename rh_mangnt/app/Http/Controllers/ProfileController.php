<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('user.profile');
    }

    public function updatePassword(Request $request)
    {
        //validacao do formulario
        $request->validate([
            'current_password' => 'required|min:8|max:16',
            'new_password' => 'required|min:8|max:16|different:current_password',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        //verificar se a senha atual ta correta
        if (!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'A senha atual é inválida.');
        }

        //salvar nova senha no db
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Senha atualizada com sucesso.');
    }

    public function updateUserData(Request $request)
    {
        //validacao do formulario
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id()
        ]);

        //atualizar dados do usuario
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success_change_data', 'Dados atualizados com sucesso.');
    }
}
