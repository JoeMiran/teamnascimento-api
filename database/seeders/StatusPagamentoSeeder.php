<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusPagamento;
use Illuminate\Support\Facades\Schema; // <-- 1. Adicione este "use"

class StatusPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints(); // <-- 2. Adicione esta linha
        StatusPagamento::truncate();
        Schema::enableForeignKeyConstraints();  // <-- 3. Adicione esta linha

        StatusPagamento::create(['rotulo' => 'Pendente']);
        StatusPagamento::create(['rotulo' => 'Pago']);
        StatusPagamento::create(['rotulo' => 'Atrasado']);
        StatusPagamento::create(['rotulo' => 'Cancelado']);
    }
}