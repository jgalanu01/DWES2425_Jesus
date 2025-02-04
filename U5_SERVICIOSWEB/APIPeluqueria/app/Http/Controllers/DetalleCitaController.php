<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\DetalleCita;
use App\Models\Servicio;
use Illuminate\Http\Request;

class DetalleCitaController extends Controller
{
    // Añadir detalle a una cita (solo si la cita no está finalizada)
    public function store(Request $request, $id)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'precio' => 'required|numeric',
        ]);

        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['error' => 'Cita no encontrada'], 404);
        }

        if ($cita->finalizada) {
            return response()->json(['error' => 'No se puede agregar detalle a una cita finalizada'], 400);
        }

        $detalleCita = new DetalleCita();
        $detalleCita->cita_id = $cita->id;
        $detalleCita->servicio_id = $request->servicio_id;
        $detalleCita->precio = $request->precio;

        $detalleCita->save();

        return response()->json($detalleCita, 201); // Devuelve el detalle creado con código 201
    }

    // Eliminar un detalle de una cita (solo si la cita no está finalizada)
    public function destroy($id, $detalleId)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['error' => 'Cita no encontrada'], 404);
        }

        if ($cita->finalizada) {
            return response()->json(['error' => 'No se puede eliminar detalle de una cita finalizada'], 400);
        }

        $detalleCita = DetalleCita::find($detalleId);

        if (!$detalleCita || $detalleCita->cita_id !== $cita->id) {
            return response()->json(['error' => 'Detalle de cita no encontrado'], 404);
        }

        $detalleCita->delete();

        return response()->json(['message' => 'Detalle de cita eliminado correctamente']);
    }
}
