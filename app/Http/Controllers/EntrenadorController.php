<?php

namespace App\Http\Controllers;

use App\Models\Entrenador;
use Illuminate\Http\Request;

class EntrenadorController extends Controller
{
    public function index()
    {
        $entrenadores = Entrenador::all();
        return response()->json($entrenadores);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'entrenador_id' => 'required|exists:users,id|unique:entrenadores,entrenador_id',
            'especialidad' => 'required|string',
            'experiencia' => 'required|string',
            'disponibilidad' => 'required|string',
            'phone_number' => 'required|numeric',
            'certificaciones' => 'required|string',
        ]);

        $entrenador = Entrenador::create($validated);

        return response()->json($entrenador, 201);
    }

    public function show($id)
    {
        $entrenador = Entrenador::findOrFail($id);
        return response()->json($entrenador);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'especialidad' => 'string',
            'experiencia' => 'string',
            'disponibilidad' => 'string',
            'phone_number' => 'numeric',
            'certificaciones' => 'string',
            'descripcion' => 'string',
        ]);

        $entrenador = Entrenador::findOrFail($id);
        $entrenador->update($validated);

        return response()->json($entrenador);
    }

    public function destroy($id)
    {
        $entrenador = Entrenador::findOrFail($id);
        $entrenador->delete();

        return response()->json(null, 204);
    }
}
