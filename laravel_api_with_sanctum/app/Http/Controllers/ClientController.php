<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mostrar todos os clientes do banco de dados
        return ApiResponse::success(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar os dados 
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'required'
        ]);

        // adicionar novo cliente ao db
        $client = Client::create($request->all());

        return ApiResponse::success($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // detalhe do cliente
        $client = Client::find($id);

        // resposta
        if ($client) {
            return ApiResponse::success($client);
        } else {
            return ApiResponse::error('Cliente não encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validar os dados 
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'required'
        ]);

        // atualizar os dados do cliente no banco de daods
        $client = Client::find($id);

        if ($client) {
            $client->update($request->all());
            return ApiResponse::success($client);
        } else {
            return ApiResponse::error('Cliente não encontrado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // deletar um cliente
        $client = Client::find($id);

        if ($client) {
            $client->delete();
            return ApiResponse::success('Cliente deletado com sucesso.');
        } else {
            return ApiResponse::error('Cliente não encontrado.');
        }
    }
}
