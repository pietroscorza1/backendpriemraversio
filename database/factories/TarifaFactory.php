<?php

namespace Database\Factories;

use App\Models\Tarifa;
use Illuminate\Database\Eloquent\Factories\Factory;

class TarifaFactory extends Factory
{
    protected $model = Tarifa::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'precio' => $this->faker->randomFloat(2, 10, 1000),
            'meses' => $this->faker->numberBetween(1, 24),
        ];
    }
}
