<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MatriculaController; // 1. Importa o novo controller

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 2. Esta linha cria o endpoint GET /api/matriculas
Route::get('/matriculas', [MatriculaController::class, 'index']);

// Esta rota é para autenticação, podes manter se fores usar
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});