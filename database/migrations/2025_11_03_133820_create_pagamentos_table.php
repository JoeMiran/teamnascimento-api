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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_matricula')->constrained('matriculas');
            $table->foreignId('id_status_pagamento')->constrained('status_pagamentos');
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable(); 
            $table->decimal('valor_cobrado', 10, 2);
            $table->decimal('valor_pago', 10, 2)->nullable(); 
            $table->unsignedInteger('referencia_mes'); 
            $table->unsignedInteger('referencia_ano'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
