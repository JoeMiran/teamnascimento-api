<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            // Só adiciona a matrícula se ela não existir
            if (!Schema::hasColumn('alunos', 'matricula')) {
                $table->string('matricula', 6)->unique()->after('id');
            }

            // Verifica a coluna CPF antes de adicionar
            if (!Schema::hasColumn('alunos', 'cpf')) {
                $table->string('cpf')->nullable()->after('nome');
            }

            if (!Schema::hasColumn('alunos', 'data_nascimento')) {
                $table->date('data_nascimento')->after('cpf');
            }

            // Adicione as outras colunas seguindo a mesma lógica de proteção
            if (!Schema::hasColumn('alunos', 'sexo')) {
                $table->string('sexo')->default('Masculino');
            }
            
            if (!Schema::hasColumn('alunos', 'endereco')) {
                $table->string('endereco')->nullable();
            }

            if (!Schema::hasColumn('alunos', 'telefone')) {
                $table->string('telefone')->nullable();
            }

            if (!Schema::hasColumn('alunos', 'responsavel_nome')) {
                $table->string('responsavel_nome')->nullable();
                $table->string('responsavel_cpf')->nullable();
            }

            if (!Schema::hasColumn('alunos', 'problemas_saude')) {
                $table->text('problemas_saude')->nullable();
            }

            if (!Schema::hasColumn('alunos', 'faixa')) {
                $table->string('faixa')->default('Branca');
            }

            if (!Schema::hasColumn('alunos', 'plano')) {
                $table->string('plano')->nullable();
            }

            if (!Schema::hasColumn('alunos', 'vencimento')) {
                $table->date('vencimento')->nullable();
            }
        });
    }
};
