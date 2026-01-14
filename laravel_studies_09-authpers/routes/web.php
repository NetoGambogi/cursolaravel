<?php

// use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// rotas para usuarios nao autenticados
Route::middleware('guest')->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        echo 'pequeno sangue';
    });
});



// Route::get('/', function () {
//     DB::connection()->getPdo(); // SE ISSO FUNCIONAR, É PORQUE O BANCO DE DADOS ESTÁ FUNCIONANDO!
// });

// Route::view('teste', 'teste')->middleware('auth'); // o middleware 'auth' procura uma rota com o NOME login

// Route::get('/login', function () {
//     echo 'login';
// })->name('login');

// Route::middleware('guest')->group(function () {
//     Route::get('/register', function () {
//         echo "registro";
//     })->name('register');
// });
