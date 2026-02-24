<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        Auth::user()->can('admin') ?: abort(403, 'Você não tem autorização para acessar essa página.');

        //busca todas as informações da organização
        $data = [];

        //buscar numero total de colaboradores(ativos)
        $data['total_colaborators'] = User::whereNull('deleted_at')->count();

        //buscar total de colaboradores deletados
        $data['total_colaborators_deleted'] = User::onlyTrashed()->count();

        //salário total de todos os colaboradores
        $data['total_salary'] = User::withoutTrashed()
            ->with('detail')
            ->get()
            ->sum(function ($colaborator) {
                return $colaborator->detail->salary;
            });

        $data['total_salary'] = 'R$ ' . number_format($data['total_salary'], 2, ',', '.');

        //total de colaboradores por departamento
        $data['total_colaborator_per_department'] = User::withoutTrashed()
            ->with('department')
            ->get()
            ->groupBy('department_id')
            ->map(function ($department) {
                return [
                    'department' => $department->first()->department->name ?? "-",
                    'total' => $department->count()
                ];
            });

        //total de salário por departamento
        $data['total_salary_by_department'] = User::withoutTrashed()
            ->with('department', 'detail')
            ->get()
            ->groupBy('department_id')
            ->map(function ($department) {
                return [
                    'department' => $department->first()->department->name ?? "-",
                    'total' => $department->sum(function ($colaborator) {
                        return $colaborator->detail->salary;
                    })
                ];
            });

        $data['total_salary_by_department'] = $data['total_salary_by_department']->map(function ($department) {
            return [
                'department' => $department['department'],
                'total' => 'R$ ' . number_format($department['total'], 2, ',', '.'),
            ];
        });

        //exibir a homepage de admin
        return view('home', compact('data'));
    }
}
