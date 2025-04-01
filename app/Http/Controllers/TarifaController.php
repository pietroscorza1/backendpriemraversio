<?php

namespace App\Http\Controllers;

use App\Models\Tarifa;
use Illuminate\Http\Request;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarifas = Tarifa::all();
        return response()->json($tarifas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'meses' => 'required|integer',
        ]);

        $tarifa = Tarifa::create($validatedData);
        return response()->json($tarifa, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarifa $tarifa)
    {
        return response()->json($tarifa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarifa $tarifa)
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'precio' => 'sometimes|required|numeric',
            'meses' => 'sometimes|required|integer',
        ]);

        $tarifa->update($validatedData);
        return response()->json($tarifa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarifa $tarifa)
    {
        $tarifa->delete();
        return response()->json(null, 204);
    }
}
