<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusAluno;
use Illuminate\Support\Facades\Schema; // <-- 1. Adicione este "use"

class StatusAlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints(); // <-- 2. Adicione esta linha
        StatusAluno::truncate();
        Schema::enableForeignKeyConstraints();  // <-- 3. Adicione esta linha

        StatusAluno::create(['rotulo' => 'Adimplente']);
        StatusAluno::create(['rotulo' => 'Inadimplente']);
        StatusAluno::create(['rotulo' => 'Em Negociação']);
        StatusAluno::create(['rotulo' => 'Inativo']);
    }
}