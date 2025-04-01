<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pago::all();
        return response()->json($pagos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'membresia_id' => 'required|exists:membresias,id',
            'tarifa_id' => 'required|exists:tarifas,id',
            'fecha_pago' => 'required|date',
            'estado' => 'required|in:pendiente,completado,fallido',
        ]);

        $pago = Pago::create($validatedData);
        return response()->json($pago, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        return response()->json($pago);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        $validatedData = $request->validate([
            'membresia_id' => 'sometimes|required|exists:membresias,id',
            'tarifa_id' => 'sometimes|required|exists:tarifas,id',
            'fecha_pago' => 'sometimes|required|date',
            'estado' => 'sometimes|required|in:pendiente,completado,fallido',
        ]);

        $pago->update($validatedData);
        return response()->json($pago);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        $pago->delete();
        return response()->json(null, 204);
    }
}
