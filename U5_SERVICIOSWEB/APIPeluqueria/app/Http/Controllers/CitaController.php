<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // Ver todas las citas del usuario logueado
    public function index()
    {
        $citas = Cita::all(); 

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

        try {
            $c = new Cita();
            $c->fecha = $request->fecha;
            $c->hora = $request->hora;
            $c->cliente = $request->cliente;

            if ($c->save()) {
                return response()->json($c);
            } else {
                return response()->json(['error' => 'Error al guardar la cita'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Detalle de una cita
    public function detalleCita(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $c = Cita::find($request->id);

            if (!$c) {
                return response()->json(['error' => 'Cita no encontrada'], 404);
            }

            return response()->json($c->detalle_citas);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error: ' . $th->getMessage()], 500);
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
