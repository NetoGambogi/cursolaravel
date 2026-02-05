<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        // buscar todos os posts e seus autores do banco de dados
        $posts = Post::with('user')->get();

        return view('home', compact('posts'));
    }
}
