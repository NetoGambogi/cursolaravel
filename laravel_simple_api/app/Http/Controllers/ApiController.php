<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function status()
    {
        return response()->json(
            [
                'status' => 'Ok',
                'message' => 'API está rodando corretamente!'
            ],
            200
        );
    }

    public function clients()
    {
        $clients = Client::paginate(10);

        return response()->json(
            [
                'status' => 'Ok',
                'message' => 'success',
                'data' => $clients
            ],
            200
        );
    }

    public function clientById($id)
    {
        $client = Client::find($id);

        return response()->json(
            [
                'status' => 'Ok',
                'message' => 'success',
                'data' => $client
            ],
            200
        );
    }

    public function client(Request $request)
    {
        //verificar se o id veio na requisiçãp
        if (!$request->id) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'O id do cliente é obrigatório.',
                ],
                400
            );
        }

        $client = Client::find($request->id);

        return response()->json(
            [
                'status' => 'Ok',
                'message' => 'success',
                'data' => $client
            ],
            200
        );
    }

    public function addClient(Request $request)
    {
        //criar um novo cliente
        $client = new Client();

        $client->name = $request->name;
        $client->email = $request->email;
        $client->save();

        return response()->json(
            [
                'status' => 'ok',
                'message' => 'success',
                'data' => $client
            ],
            200
        );
    }

    public function updateClient(Request $request)
    {
        //verificar se o id veio na requisiçãp
        if (!$request->id) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'O id do cliente é obrigatório.',
                ],
                400
            );
        }

        //atualizar cliente
        $client = Client::find($request->id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->save();

        return response()->json(
            [
                'status' => 'ok',
                'message' => 'success',
                'data' => $client
            ],
            200
        );
    }

    public function deleteClient($id)
    {
        //buscar o cliente por id
        $client = Client::find($id);

        $client->delete();

        return response()->json(
            [
                'status' => 'ok',
                'message' => 'success',
            ],
            200
        );
    }
}
