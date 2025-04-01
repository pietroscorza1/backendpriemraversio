<?php

namespace Database\Factories;

use App\Models\Membresia;
use App\Models\Pago;
use App\Models\Tarifa;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoFactory extends Factory
{
    protected $model = Pago::class;

    public function definition()
    {
        return [
            'membresia_id' => Membresia::factory(),
            'tarifa_id' => Tarifa::factory(),
            'fecha_pago' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['pendiente', 'completado', 'fallido']),
        ];
    }
}
