<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RhManagementController extends Controller
{
    public function home()
    {
        Auth::user()->can('rh') ?: abort(403, 'Você não tem autorização para acessar essa página.');

        //buscar todos os colaboradores que não possuem a role admin ou rh.

        $colaborators = User::with('details', 'department')
            ->where('role', 'colaborator')
            ->withTrashed()
            ->get();

        return view('colaborators.colaborators', compact('colaborators'));
    }

    public function newColaborator()
    {
        Auth::user()->can('rh') ?: abort(403, 'Você não tem autorização para acessar essa página.');

        $departments = Department::where('id', '>', 2)->get();

        // se não tiver departamentos, não permite criar novos colaboradores
        if ($departments->count() === 0) {
            abort(403, 'Não existem departamentos para adicionar um novo colaborador. Por favor, contate os administradores do sistema para adicionar um novo departamento.');
        }

        return view('colaborators.add-colaborator', compact('departments'));
    }
}
