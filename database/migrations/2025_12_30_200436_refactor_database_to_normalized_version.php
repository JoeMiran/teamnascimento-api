<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Desativar verificações para permitir limpeza de tabelas com dependências
        Schema::disableForeignKeyConstraints();

        // 2. Limpeza de tabelas redundantes
        Schema::dropIfExists('pagamentos');
        Schema::dropIfExists('matriculas');
        Schema::dropIfExists('status_alunos');
        Schema::dropIfExists('status_pagamentos');

        // 3. Ajustes na tabela ALUNOS
        Schema::table('alunos', function (Blueprint $table) {
            // REMOVER A FOREIGN KEY PRIMEIRO (O passo que faltava)
            if (Schema::hasColumn('alunos', 'id_status')) {
                // No Laravel, o padrão do nome é: nome_tabela_nome_coluna_foreign
                $table->dropForeign(['id_status']); 
                $table->dropColumn('id_status');
            }

            // Remover outras colunas obsoletas
            if (Schema::hasColumn('alunos', 'id_matricula')) {
                // Tentamos remover a constraint caso exista também para matricula
                try { $table->dropForeign(['id_matricula']); } catch (\Exception $e) {}
                $table->dropColumn('id_matricula');
            }
            
            if (Schema::hasColumn('alunos', 'vencimento')) $table->dropColumn('vencimento');
            if (Schema::hasColumn('alunos', 'faixa')) $table->dropColumn('faixa');

            // GARANTIR NOVAS COLUNAS PARA O VUE
            if (!Schema::hasColumn('alunos', 'matricula')) {
                $table->string('matricula', 6)->unique()->after('id');
            }
            
            if (!Schema::hasColumn('alunos', 'responsavel_nome')) {
                $table->string('responsavel_nome')->nullable();
                $table->string('responsavel_cpf')->nullable();
            }

            if (!Schema::hasColumn('alunos', 'status')) {
                $table->string('status')->default('Ativo');
            }
        });

        // 4. Criação da tabela de MENSALIDADES (se não existir)
        if (!Schema::hasTable('mensalidades')) {
            Schema::create('mensalidades', function (Blueprint $table) {
                $table->id();
                $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
                $table->decimal('valor_vencimento', 10, 2);
                $table->decimal('valor_pago', 10, 2)->nullable();
                $table->date('data_vencimento');
                $table->date('data_pagamento')->nullable();
                $table->string('status')->default('pendente');
                $table->string('mes_referencia', 7); 
                $table->timestamps();
            });
        }

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        // Em refatorações de limpeza, o down geralmente fica vazio ou recria a estrutura básica
    }
};