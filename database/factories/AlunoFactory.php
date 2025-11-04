<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StatusAluno; // Importar o Model

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aluno>
 */
class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'cpf' => $this->faker->unique()->numerify('###########'), // Gera um CPF falso de 11 dígitos
            'endereco' => $this->faker->address(),
            'data_nascimento' => $this->faker->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
            'faixa' => $this->faker->randomElement(['Branca', 'Azul', 'Roxa', 'Marrom', 'Preta']),
            
            // Pega um ID aleatório da tabela de status que acabámos de popular
            'id_status' => StatusAluno::inRandomOrder()->first()->id, 
        ];
    }
}