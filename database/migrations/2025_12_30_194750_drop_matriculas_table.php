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
        // 1. Desativa a verificação de chaves estrangeiras
        Schema::disableForeignKeyConstraints();

        // 2. Apaga a tabela
        Schema::dropIfExists('matriculas');

        // 3. Reativa a verificação (importante para manter a segurança do banco)
        Schema::enableForeignKeyConstraints();
    }

public function down(): void
{
    // Caso queira desfazer, teria que recriar a estrutura manual aqui
    Schema::create('matriculas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_aluno');
        $table->foreignId('id_plano');
        $table->date('data_inicio');
        $table->integer('dia_vencimento');
        $table->boolean('ativa');
        $table->timestamps();
    });
}
};
