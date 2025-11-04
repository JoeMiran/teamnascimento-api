<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plano;
use Illuminate\Support\Facades\Schema; // <-- 1. Adicione este "use"

class PlanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints(); // <-- 2. Adicione esta linha
        Plano::truncate();
        Schema::enableForeignKeyConstraints();  // <-- 3. Adicione esta linha

        Plano::create([
            'nome' => 'Plano Mensal',
            'valor' => 120.00,
            'periodicidade' => 'Mensal'
        ]);

        Plano::create([
            'nome' => 'Plano Trimestral',
            'valor' => 330.00,
            'periodicidade' => 'Trimestral'
        ]);

        Plano::create([
            'nome' => 'Plano Semestral',
            'valor' => 600.00,
            'periodicidade' => 'Semestral'
        ]);
    }
}