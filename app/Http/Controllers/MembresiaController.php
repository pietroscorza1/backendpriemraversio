<?php
namespace App\Http\Controllers;

use App\Models\Membresia;
use App\Models\Pago;
use App\Models\PagoAdministrador;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MembresiaController extends Controller
{
    public function from_admin(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'fecha_fin' => 'required|date',
                'importe' => 'required|numeric',
            ]);

            $membresia = Membresia::where('user_id', $id)->first();

            if ($membresia) {
                $membresia->fecha_fin = $data['fecha_fin'];
                $membresia->save();
            } else {
                $uuid = Str::uuid()->toString();
                $membresia = Membresia::create([
                    'user_id' => $id,
                    'fecha_fin' => $data['fecha_fin'],
                    'qr_data' => $uuid,
                ]);
            }

            PagoAdministrador::create([
                'membresia_id' => $membresia->id,
                'importe' => $data['importe'],
                'fecha_pago' => now(),
            ]);

            return response()->json(['message' => 'Fecha actualizada correctamente'], 200);

        } catch (\Exception $e) {
            print $e->getMessage();
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tarifa_id' => 'required|exists:tarifas,id',
            'fecha_fin' => 'required|date',
        ]);

        // Intentar encontrar la membresía existente
        $membresia = Membresia::where('user_id', $request->user_id)->first();

        if ($membresia) {
            $membresia->fecha_fin = $request->fecha_fin;
            $membresia->save();
        } else {
            // Si no existe una membresía, creamos una nueva
            $uuid = Str::uuid()->toString();
            $membresia = Membresia::create([
                'user_id' => $request->user_id,
                'fecha_fin' => $request->fecha_fin,
                'qr_data' => $uuid,
            ]);
        }
        Pago::create([
            'membresia_id' => $membresia->id,
            'tarifa_id' => $request->tarifa_id,
            'fecha_pago' => now(),
            'estado' => 'completado',
        ]);
        // Devolver la respuesta
        return response()->json($membresia, 201);
    }


    public function index()
    {
        $membresias = Membresia::all();
        return response()->json($membresias);
    }

    public function show($id)
    {
        $membresia = Membresia::findOrFail($id);
        return response()->json($membresia);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha_fin' => 'required|date',
            'estado' => 'required|boolean',
            'qr_data' => 'required|string',
        ]);

        $membresia = Membresia::findOrFail($id);

        $membresia->update($request->all());

        return response()->json($membresia);
    }

    public function destroy($id)
    {
        $membresia = Membresia::findOrFail($id);
        $membresia->delete();

        return response()->json(null, 204);
    }
}
