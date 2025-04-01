<?php
namespace Tests\Unit;

use App\Models\Clase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClaseApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_update_a_clase()
    {
        $user = User::factory()->create();
        $clase = Clase::factory()->create([
            'nombre' => 'Yoga para principiantes',
            'descripcion' => 'Clase de yoga básica',
            'id_entrenador' => $user->id,
            'maximo_participantes' => 20,
        ]);

        $updateData = [
            'nombre' => 'Yoga para avanzados',
            'descripcion' => 'Clase de yoga para niveles avanzados',
            'id_entrenador' => $user->id,
            'maximo_participantes' => 15,
            'horarios' => [
                ['dia' => 'Lunes', 'hora_inicio' => '08:00', 'hora_fin' => '09:00'],
                ['dia' => 'Miércoles', 'hora_inicio' => '08:00', 'hora_fin' => '09:00'],
            ]
        ];

        $response = $this->actingAs($user)->putJson("/api/clases/{$clase->id}", $updateData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('clases', [
            'id' => $clase->id,
            'nombre' => 'Yoga para avanzados',
            'descripcion' => 'Clase de yoga para niveles avanzados',
            'id_entrenador' => $user->id,
            'maximo_participantes' => 15,
        ]);

        foreach ($updateData['horarios'] as $horario) {
            $this->assertDatabaseHas('horarios', [
                'clase_id' => $clase->id,
                'dia' => $horario['dia'],
                'hora_inicio' => $horario['hora_inicio'],
                'hora_fin' => $horario['hora_fin'],
            ]);
        }
    }
    /** @test */
    public function it_can_create_a_clase()
    {
        $user = User::factory()->create();

        $data = [
            'nombre' => 'Yoga para avanzados',
            'descripcion' => 'Clase de yoga para niveles avanzados',
            'id_entrenador' => $user->id,
            'maximo_participantes' => 15,
            'horarios' => [
                ['dia' => 'Lunes', 'hora_inicio' => '08:00', 'hora_fin' => '09:00'],
                ['dia' => 'Miércoles', 'hora_inicio' => '08:00', 'hora_fin' => '09:00'],
            ]
        ];

        $response = $this->actingAs($user)->postJson('/api/clases', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('clases', [
            'nombre' => 'Yoga para avanzados',
            'descripcion' => 'Clase de yoga para niveles avanzados',
            'id_entrenador' => $user->id,
        ]);

        // Verificar que los horarios también se hayan creado
        foreach ($data['horarios'] as $horario) {
            $this->assertDatabaseHas('horarios', [
                'dia' => $horario['dia'],
                'hora_inicio' => $horario['hora_inicio'],
                'hora_fin' => $horario['hora_fin'],
            ]);
        }
    }

    /** @test */
    public function it_can_get_all_clases()
    {
        // Crear algunas clases de prueba
        Clase::factory()->create();

        // Realizar la solicitud GET para obtener las clases
        $response = $this->getJson('/api/clases');

        // Verificar que la respuesta sea exitosa
        $response->assertStatus(200);

    }
}
