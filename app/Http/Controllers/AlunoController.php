<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
   public function store(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                // Criar o Aluno traduzindo o que vem do Vue
                $aluno = Aluno::create([
                    'nome'             => $request->nome,
                    'cpf'              => $request->cpf,
                    'data_nascimento'  => $request->dataNascimento, // Vue -> Banco
                    'sexo'             => $request->sexo,
                    'endereco'         => $request->endereco,
                    'telefone'         => $request->telefone,
                    'responsavel_nome' => $request->responsavelNome, // Vue -> Banco
                    'responsavel_cpf'  => $request->responsavelCpf,  // Vue -> Banco
                    'problemas_saude'  => $request->problemasSaude,
                    'plano'            => $request->plano,
                    'status'           => 'Ativo'
                ]);

                // Mensalidade Inicial
                $aluno->mensalidades()->create([
                    'valor_vencimento' => 150.00, 
                    'data_vencimento'  => $request->vencimento,
                    'status'           => 'pendente',
                    'mes_referencia'   => date('m/Y', strtotime($request->vencimento))
                ]);

                // Histórico de Faixas
                if ($request->has('faixasHistorico')) {
                    foreach ($request->faixasHistorico as $faixa) {
                        $aluno->faixas()->create([
                            'faixa'         => $faixa['faixa'],
                            'data_obtencao' => $faixa['dataObtencao'] ?: null,
                            'grau'          => $faixa['grau'] ?: 0
                        ]);
                    }
                }

                return response()->json(['message' => 'Sucesso!'], 201);
            });
        } catch (\Exception $e) {
            // Se der erro 500, isto vai dizer o porquê no log do navegador
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}