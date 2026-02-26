<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home(): View
    {
        $data = [
            'value4' => 'Valor de variável definida no controller' 
        ];

        return view('home')->with($data);
    }

    public function showClients(): View
    {
        $clients = [
            ['id' => 1, 'name' => 'Client 1', 'phone' => '1234567891'],
            ['id' => 2, 'name' => 'Client 2', 'phone' => '1234567892'],
            ['id' => 3, 'name' => 'Client 3', 'phone' => '1234567893'],
            ['id' => 4, 'name' => 'Client 4', 'phone' => '1234567894'],
            ['id' => 5, 'name' => 'Client 5', 'phone' => '1234567895'],
        ];

        return view('clients', compact('clients'));
    }
}
