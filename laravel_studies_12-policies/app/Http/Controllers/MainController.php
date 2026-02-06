<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        // buscar todos os posts e seus autores do banco de dados
        $posts = Post::with('user')->get();

        return view('home', compact('posts'));
    }

    public function update($id)
    {
        $post = Post::find($id);

        // verifica se o usuario é permitido para atualizar o post
        if (Auth::user()->can('update', $post)) {
            echo "o usuario tem essa permissao.";
        } else {
            echo "voce nao tem permissao";
        };
    }

    public function delete($id)
    {
        $post = Post::find($id);

        // verifica se o usuario é permitido para deletar o post
        if (Auth::user()->can('delete', $post)) {
            echo "o usuario tem essa permissao.";
        } else {
            echo "voce nao tem permissao";
        };
    }

    public function create()
    {
        // verifica se o usuario é permitido para criar um novo post
        // if(Auth::user()->can('create', Post::class)){
        //     echo "o usuario pode criar um post.";
        // } else {
        //     echo "voce nao tem permissao";
        // };

        // ------------------------------------------
        // $response = Gate::inspect('create', Post::class);

        // if ($response->allowed()) {
        //     echo 'usuario pode criar post';
        // } else {
        //     echo $response->message();
        // }

        // ------------------------------------------
        $response = Gate::inspect('create', Post::class);

        if ($response->allowed()) {
            echo 'usuario pode criar post';
        } else {
            if ($response->status() === 403) {
                abort(403, $response->message());
            }
        }
    }
}
