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
            // 'Ativo' por padrão ao matricular
            if (!Schema::hasColumn('alunos', 'status')) {
                $table->string('status')->default('Ativo')->after('plano');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            //
        });
    }
};
