<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Aluno;
use App\Models\Plano;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matricula>
 */
class MatriculaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Por padrão, esta factory cria um novo aluno e pega um plano aleatório
            'id_aluno' => Aluno::factory(), 
            'id_plano' => Plano::inRandomOrder()->first()->id,
            'data_inicio' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'dia_vencimento' => $this->faker->randomElement([5, 10, 15, 20]),
            'ativa' => true,
        ];
    }
}