<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Matricula;
use App\Models\StatusPagamento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pagamento>
 */
class PagamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_matricula' => Matricula::factory(),
            'id_status_pagamento' => StatusPagamento::inRandomOrder()->first()->id,
            'data_vencimento' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'data_pagamento' => null, // Por padrão, não está pago
            'valor_cobrado' => $this->faker->randomFloat(2, 100, 300),
            'valor_pago' => null,
            'referencia_mes' => $this->faker->month(),
            'referencia_ano' => $this->faker->year(),
        ];
    }
}