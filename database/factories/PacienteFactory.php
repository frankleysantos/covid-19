<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nome" => $this->faker->nome,
            "cpf" => $this->faker->cpf,
            "telefone" => $this->faker->telefone,
        ];
    }
}
