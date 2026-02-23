<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function updateUserAddress(Request $request)
    {
        //validacao do formulario
        $request->validate([
            'address' => 'required|min:3|max:100',
            'zip_code' => 'required|min:3|max:10',
            'city' => 'required|min:3|max:50',
            'phone' => 'required|min:8|max:20',
        ]);

        //buscar o detalhes do usuario
        $user = User::with('detail')->findOrFail(auth()->id());

        $user->detail->address = $request->address;
        $user->detail->zip_code = $request->zip_code;
        $user->detail->city = $request->city;
        $user->detail->phone = $request->phone;
        $user->detail->save();

        return redirect()->back()->with('success_change_address', 'Dados atualizados com sucesso.');
    }
}
