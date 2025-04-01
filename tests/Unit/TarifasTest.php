<?php

namespace Tests\Unit;

use App\Models\Membresia;
use App\Models\Tarifa;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TarifasTest extends TestCase
{
    #[Test]
    public function it_can_list_all_tarifas()
    {
        Tarifa::factory()->count(3)->create();

        $response = $this->getJson('/api/tarifas');

        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_create_a_tarifa()
    {
        $data = [
            'nombre' => 'Tarifa Test',
            'precio' => 99.99,
            'meses' => 12,
        ];

        $response = $this->postJson('/api/tarifas', $data);

        $response->assertStatus(201)
            ->assertJsonFragment($data);

        $this->assertDatabaseHas('tarifas', $data);
    }

    #[Test]
    public function it_can_show_a_tarifa()
    {
        $tarifa = Tarifa::factory()->create();

        $response = $this->getJson("/api/tarifas/{$tarifa->id}");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'nombre' => $tarifa->nombre,
                'precio' => $tarifa->precio,
                'meses' => $tarifa->meses,
            ]);
    }

    #[Test]
    public function it_can_update_a_tarifa()
    {
        $tarifa = Tarifa::factory()->create();

        $data = [
            'nombre' => 'Updated Tarifa',
            'precio' => 199.99,
            'meses' => 24,
        ];

        $response = $this->putJson("/api/tarifas/{$tarifa->id}", $data);

        $response->assertStatus(200)
            ->assertJsonFragment($data);

        $this->assertDatabaseHas('tarifas', $data);
    }

    #[Test]
    public function it_can_delete_a_tarifa()
    {
        $tarifa = Tarifa::factory()->create();

        $response = $this->deleteJson("/api/tarifas/{$tarifa->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('tarifas', ['id' => $tarifa->id]);
    }
}
