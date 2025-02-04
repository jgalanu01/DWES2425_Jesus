<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // Ver todas las citas del usuario logueado
    public function index()
    {
        $citas = Cita::all(); // Obtiene todas las citas

        return response()->json($citas);
    }

    // Crear una nueva cita
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'cliente' => 'required|string|max:255',
        ]);

        $cita = new Cita();
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->cliente = $request->cliente;
        $cita->finalizada = false;

        if ($cita->save()) {
            return response()->json($cita, 201); // Retorna la cita creada con código 201
        } else {
            return response()->json(['error' => 'No se pudo crear la cita'], 500);
        }
    }

    // Ver una cita específica
    public function show($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['error' => 'Cita no encontrada'], 404);
        }

        return response()->json($cita);
    }

    // Finalizar cita
    public function finalizar($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['error' => 'Cita no encontrada'], 404);
        }

        if ($cita->finalizada) {
            return response()->json(['error' => 'La cita ya está finalizada'], 400);
        }

        $cita->finalizada = true;
        $cita->save();

        return response()->json(['message' => 'Cita finalizada correctamente']);
    }

    // Eliminar cita
    public function destroy($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['error' => 'Cita no encontrada'], 404);
        }

        // Solo se puede borrar si no tiene detalles
        if ($cita->detalleCitas->isNotEmpty()) {
            return response()->json(['error' => 'No se puede eliminar una cita con detalles'], 400);
        }

        $cita->delete();
        return response()->json(['message' => 'Cita eliminada correctamente']);
    }
}
