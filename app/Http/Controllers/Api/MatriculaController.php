<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matricula; // 1. Importa o teu modelo Matricula
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Exibe uma lista de todas as matrículas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 2. Busca todas as matrículas da base de dados
        $matriculas = Matricula::all();

        // 3. Retorna os dados em formato JSON
        // O Laravel faz esta conversão automaticamente
        return response()->json($matriculas);
    }

    // (Aqui poderíamos adicionar outros métodos: show, store, update, delete)
}