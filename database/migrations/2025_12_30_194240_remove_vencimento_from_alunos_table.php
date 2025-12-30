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
            // Removemos a coluna que não é mais necessária
            if (Schema::hasColumn('alunos', 'vencimento')) {
                $table->dropColumn('vencimento');
            }
        });
    }

    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            // Caso precise desfazer, adicionamos ela de volta
            $table->date('vencimento')->nullable();
        });
    }
};
