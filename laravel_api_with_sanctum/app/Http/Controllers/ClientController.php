<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mostrar todos os clientes do banco de dados
        return response()->json(Client::all(), 200);
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

        return response()->json(
            [
                'message' => 'Cliente criado com sucesso.',
                'data' => $client,
            ],
            200
        );
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
            return response()->json($client, 200);
        } else {
            return response()->json(['message' => 'Cliente não encontrado.'], 404);
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
            return response()->json(
                [
                    'message' => 'Cliente atualizado com sucesso.',
                    'data' => $client
                ],
                200
            );
        } else {
            return response()->json(['message' => 'Cliente não encontrado.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
