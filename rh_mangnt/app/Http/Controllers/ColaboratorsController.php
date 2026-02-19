<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ColaboratorsController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem autorização para acessar essa página.');

        $colaborators = User::with('detail', 'department')
                        ->where('role', '<>', 'admin')
                        ->get();

        return view('colaborators.admin-all-colaborators')->with('colaborators', $colaborators);
    }
}
