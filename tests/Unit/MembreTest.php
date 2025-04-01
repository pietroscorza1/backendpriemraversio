<?php

namespace Tests\Unit;

use App\Models\Membresia;
use App\Models\Tarifa;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
class MembreTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->tarifa = Tarifa::factory()->create();
    }

    #[Test]
    public function it_creates_a_membresia_successfully(): void
    {
        $data = [
            'user_id' => $this->user->id,
            'tarifa_id' => $this->tarifa->id,
            'fecha_fin' => now()->addMonth()->toDateTimeString(), // Remove precision
        ];

        $response = $this->postJson('/api/membresias', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('membresias', [
            'user_id' => $this->user->id,
            'fecha_fin' => $data['fecha_fin'],
        ]);


        $membresia = Membresia::latest()->first();
        $this->assertNotEmpty($membresia->qr_data);

        $resposedos = $this->get('/api/users/' . $this->user->id . '/membresia');

        $resposedos->assertStatus(200);
    }

    #[Test]
    public function it_requires_user_id_to_create_membresia()
    {
        // Datos incompletos (falta user_id)
        $data = [
            'fecha_fin' => now()->addMonth(),
            'estado' => true,
        ];

        // Intentar crear una membresía
        $response = $this->postJson('/api/membresias', $data);

        // Verificar que falla con un error de validación
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('user_id');
    }


}
