<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function storageLocalCreate()
    {
        Storage::disk('local')->put('file2.txt', 'Conteúdo do arquivo 2');

        return redirect()->route('home');
    }

    public function StorageLocalAppend()
    {
        Storage::disk('local')->append('file3.txt', Str::random(100));

        return redirect()->route('home');
    }

    public function StorageLocalRead()
    {
        $content = Storage::disk('local')->get('file1.txt');
        echo $content;
    }

    public function storageLocalReadMulti()
    {
        $lines = Storage::disk('local')->get('file3.txt');
        $lines = explode(PHP_EOL, $lines);

        foreach ($lines as $line) {
            echo "<p>$line</p>";
        }
    }

    public function StorageLocalCheckFile()
    {
        $exists = Storage::disk('local')->exists('file1.txt');

        if ($exists) {
            echo 'O arquivo existe';
        } else {
            echo 'O arquivo não existe';
        }

        echo '<br>';

        if (Storage::disk('local')->missing('file100.txt')) {
            echo 'O arquivo não existe';
        } else {
            echo 'O arquivo existe';
        }
    }

    public function storeJson()
    {
        $data = [
            [
                'name' => 'neto',
                'email' => 'neto@teste.com'
            ],
            [
                'name' => 'ana',
                'email' => 'ana@teste.com'
            ],
            [
                'name' => 'laysa',
                'email' => 'laysa@teste.com'
            ],
        ];

        Storage::disk('local')->put('data.json', json_encode($data));

        return 'Arquivo Json criado';
    }

    public function readJson()
    {
        $data = Storage::disk('local')->json('data.json');
        echo '<pre>';
        print_r($data);
    }

    public function listFiles()
    {
        $files = Storage::disk('local')->files();

        echo '<pre>';
        print_r($files);
    }
}
