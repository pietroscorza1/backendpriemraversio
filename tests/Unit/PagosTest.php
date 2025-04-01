<?php

namespace Tests\Unit;

use App\Models\Pago;
use App\Models\Membresia;
use App\Models\Tarifa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PagosTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_pago()
    {
        $membresia = Membresia::factory()->create();
        $tarifa = Tarifa::factory()->create();

        $pago = Pago::create([
            'membresia_id' => $membresia->id,
            'tarifa_id' => $tarifa->id,
            'fecha_pago' => now(),
            'estado' => 'pendiente',
        ]);

        $this->assertDatabaseHas('pagos', [
            'membresia_id' => $membresia->id,
            'tarifa_id' => $tarifa->id,
            'estado' => 'pendiente',
        ]);
    }

    #[Test]
    public function it_can_delete_a_pago()
    {
        $pago = Pago::factory()->create();

        $pago->delete();

        $this->assertDatabaseMissing('pagos', [
            'id' => $pago->id,
        ]);
    }
}
