<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return ApiResponse::success('Api esta rodando');
})->middleware('auth:sanctum');

// Route::apiResource('clients', ClientController::class)->middleware('auth:sanctum');

Route::get('clients', [ClientController::class, 'index'])->middleware(['auth:sanctum', 'ability:clients:list']);
Route::post('clients', [ClientController::class, 'store']);
Route::get('clients/{client}', [ClientController::class, 'show'])->middleware(['auth:sanctum', 'ability:clients:detail']);
Route::put('clients/{client}', [ClientController::class, 'update']);
Route::delete('clients/{client}', [ClientController::class, 'delete']);

// rotas de autenticacao
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
