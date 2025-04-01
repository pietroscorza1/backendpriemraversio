<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Membresia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MembresiaFactory extends Factory
{
    protected $model = Membresia::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'fecha_fin' => $this->faker->dateTimeBetween('now', '+1 year'),
            'qr_data' => Str::uuid()->toString(),
        ];
    }
}
