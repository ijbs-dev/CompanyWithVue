<?php // Path: CompanyWithVue\database\factories\CollaboratorFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collaborator>
 */
class CollaboratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail, // E-mail do colaborador com no máximo 90 caracteres
            'phone' => $this->faker->e164PhoneNumber, // Telefone do colaborador com no máximo 25 caracteres
            'sector_id' => $this->faker->numberBetween(1, 10), // ID do setor do colaborador
        ];
    }
}
