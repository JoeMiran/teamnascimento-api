<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;

// O Laravel adiciona automaticamente o prefixo /api, 
// então a rota final será http://localhost:8000/api/alunos
Route::post('/alunos', [AlunoController::class, 'store']);