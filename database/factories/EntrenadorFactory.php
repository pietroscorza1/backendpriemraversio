<?php

namespace Database\Factories;

use App\Models\Entrenador;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entrenador>
 */
class EntrenadorFactory extends Factory
{
    protected $model = Entrenador::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'entrenador_id' => User::factory(),
            'especialidad' => $this->faker->word,
            'experiencia' => $this->faker->sentence,
            'disponibilidad' => $this->faker->word,
            'phone_number' => $this->faker->phoneNumber,
            'certificaciones' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
        ];
    }
}
