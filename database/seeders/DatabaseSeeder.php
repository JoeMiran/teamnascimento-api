<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Pagamento;
use App\Models\Plano;
use App\Models\StatusAluno;
use App\Models\StatusPagamento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. EXECUTAR OS SEEDERS DE DADOS ESSENCIAIS
        // ------------------------------------------------
        // É crucial que eles venham primeiro!
        $this->call([
            StatusAlunoSeeder::class,
            StatusPagamentoSeeder::class,
            PlanoSeeder::class,
        ]);

        // 2. BUSCAR OS IDs QUE ACABÁMOS DE CRIAR
        // ------------------------------------------------
        $planoMensal = Plano::where('nome', 'Plano Mensal')->first();
        $planoTrimestral = Plano::where('nome', 'Plano Trimestral')->first();
        
        $statusAdimplente = StatusAluno::where('rotulo', 'Adimplente')->first();
        $statusInadimplente = StatusAluno::where('rotulo', 'Inadimplente')->first();

        $statusPago = StatusPagamento::where('rotulo', 'Pago')->first();
        $statusPendente = StatusPagamento::where('rotulo', 'Pendente')->first();


        // 3. CRIAR DADOS FAKE RELACIONADOS
        // ------------------------------------------------

        // Criar 20 Alunos "Adimplentes" com Plano Mensal
        Aluno::factory(20)->create([
            'id_status' => $statusAdimplente->id,
        ])->each(function ($aluno) use ($planoMensal, $statusPago, $statusPendente) {
            
            // Para cada aluno, criar 1 Matrícula ativa
            $matricula = Matricula::factory()->create([
                'id_aluno' => $aluno->id,
                'id_plano' => $planoMensal->id,
                'ativa' => true,
                'dia_vencimento' => 10,
                'data_inicio' => now()->subMonths(6), // Começou 6 meses atrás
            ]);

            // Criar 5 pagamentos "Pagos" (histórico)
            for ($i = 5; $i >= 1; $i--) {
                Pagamento::factory()->create([
                    'id_matricula' => $matricula->id,
                    'id_status_pagamento' => $statusPago->id,
                    'data_vencimento' => now()->subMonths($i)->setDay(10),
                    'data_pagamento' => now()->subMonths($i)->setDay(11), // Pagou no dia seguinte
                    'valor_cobrado' => $planoMensal->valor,
                    'valor_pago' => $planoMensal->valor,
                    'referencia_mes' => now()->subMonths($i)->month,
                    'referencia_ano' => now()->subMonths($i)->year,
                ]);
            }

            // Criar o pagamento "Pendente" deste mês
            Pagamento::factory()->create([
                'id_matricula' => $matricula->id,
                'id_status_pagamento' => $statusPendente->id,
                'data_vencimento' => now()->setDay(10),
                'data_pagamento' => null,
                'valor_cobrado' => $planoMensal->valor,
                'valor_pago' => null,
                'referencia_mes' => now()->month,
                'referencia_ano' => now()->year,
            ]);
        });


        // Criar 5 Alunos "Inadimplentes" com Plano Trimestral
        Aluno::factory(5)->create([
            'id_status' => $statusInadimplente->id,
        ])->each(function ($aluno) use ($planoTrimestral, $statusPendente) {
            // ... (Pode adicionar a lógica de pagamentos pendentes aqui se quiser)
            Matricula::factory()->create([
                'id_aluno' => $aluno->id,
                'id_plano' => $planoTrimestral->id,
                'ativa' => true,
                'dia_vencimento' => 20,
            ]);
        });

        // Criar 10 Alunos aleatórios (sem matrícula)
        Aluno::factory(10)->create();
    }
}