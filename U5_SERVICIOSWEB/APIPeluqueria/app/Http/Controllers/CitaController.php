<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Detalle_cita;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CitaController extends Controller
{
    /**
     * Obtener todas las citas con el importe total (sin detalles).
     */
    public function index()
    {
        try {
            $citas = Cita::all();
            foreach ($citas as $cita) {
                $cita->importe_total = $cita->detalle_citas()->sum('precio');
            }
            return response()->json($citas);
        } catch (\Throwable $th) {
            return response()->json('Error: ' . $th->getMessage());
        }
    }

    /**
     * Crear una nueva cita.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'cliente' => 'required'
        ]);
        try {
            $c = new Cita();
            $c->fecha = $request->fecha;
            $c->hora = $request->hora;
            $c->cliente = $request->cliente;
            $c->save();
            return response()->json($c);
        } catch (\Throwable $th) {
            return response()->json('Error: ' . $th->getMessage());
        }
    }

    /**
     * Obtener el detalle de una cita.
     */
    public function detalleCita($id)
    {
        try {
            $cita = Cita::find($id);
            if (!$cita) {
                return response()->json('Cita no encontrada');
            }
            return response()->json($cita->detalle_citas());
        } catch (\Throwable $th) {
            return response()->json('Error: ' . $th->getMessage());
        }
    }

    /**
     * Agregar un detalle a una cita (solo si no está finalizada).
     */
    public function agregarDetalle(Request $request)
    {
        $request->validate([
            'cita_id' => 'required',
            'servicio_id' => 'required',
            'precio' => 'required|numeric'
        ]);
        try {
            $cita = Cita::find($request->cita_id);
            if (!$cita || $cita->finalizada) {
                return response()->json('No se puede agregar detalle a esta cita');
            }
            $detalle = new Detalle_cita();
            $detalle->cita_id = $request->cita_id;
            $detalle->servicio_id = $request->servicio_id;
            $detalle->precio = $request->precio;
            $detalle->save();
            return response()->json('Detalle agregado correctamente');
        } catch (\Throwable $th) {
            return response()->json('Error: ' . $th->getMessage());
        }
    }

    /**
     * Borrar un detalle de una cita (solo si no está finalizada).
     */
    public function borrarDetalle($id)
    {
        try {
            $detalle = Detalle_cita::find($id);
            if (!$detalle || $detalle->cita->finalizada) {
                return response()->json('No se puede eliminar este detalle');
            }
            $detalle->delete();
            return response()->json('Detalle eliminado correctamente');
        } catch (\Throwable $th) {
            return response()->json('Error: ' . $th->getMessage());
        }
    }

    /**
     * Borrar una cita (solo si no tiene detalles).
     */
    public function borrarCita($id)
    {
        try {
            $cita = Cita::find($id);
            if (!$cita || $cita->detalle_citas()->count() > 0) {
                return response()->json('No se puede eliminar esta cita');
            }
            $cita->delete();
            return response()->json('Cita eliminada correctamente');
        } catch (\Throwable $th) {
            return response()->json('Error: ' . $th->getMessage());
        }
    }

    /**
     * Finalizar una cita.
     */
    public function finalizarCita($id)
    {
        try {
            $cita = Cita::find($id);
            if (!$cita) {
                return response()->json('Cita no encontrada');
            }
            $cita->finalizada = true;
            $cita->save();
            return response()->json('Cita finalizada correctamente');
        } catch (\Throwable $th) {
            return response()->json('Error: ' . $th->getMessage());
        }
    }
}
