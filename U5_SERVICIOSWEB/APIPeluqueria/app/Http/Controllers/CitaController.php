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
            // Obtener todas las citas de la base de datos
            $citas = Cita::all();

            // Para cada cita, calcular el importe total sumando los precios de sus detalles
            foreach ($citas as $cita) {
                $cita->importe_total = $cita->detalle_citas()->sum('precio');
            }

            // Devolver la lista de citas en formato JSON
            return response()->json($citas);
        } catch (\Throwable $th) {
            // Capturar cualquier error y devolverlo en formato JSON
            return response()->json('Error: ' . $th->getMessage());
        }
    }

    /**
     * Crear una nueva cita.
     */
    public function store(Request $request)
    {
        // Validar que los campos requeridos están presentes en la solicitud
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'cliente' => 'required'
        ]);
        try {
            // Crear una nueva instancia de Cita con los datos recibidos
            $c = new Cita();
            $c->fecha = $request->fecha;
            $c->hora = $request->hora;
            $c->cliente = $request->cliente;

            // Guardar la cita en la base de datos
            $c->save();

            // Devolver la cita creada en formato JSON
            return response()->json($c);
        } catch (\Throwable $th) {
            // Capturar cualquier error y devolverlo en formato JSON
            return response()->json('Error: ' . $th->getMessage());
        }
    }

    /**
     * Obtener el detalle de una cita específica.
     */
    public function detalleCita($id)
    {
        try {
            // Buscar la cita por su ID
            $cita = Cita::find($id);

            // Verificar si la cita existe
            if (!$cita) {
                return response()->json('Cita no encontrada');
            }

            // Devolver los detalles de la cita en formato JSON
            return response()->json($cita->detalle_citas());
        } catch (\Throwable $th) {
            // Capturar cualquier error y devolverlo en formato JSON
            return response()->json('Error: ' . $th->getMessage());
        }
    }

    /**
     * Agregar un detalle a una cita (solo si no está finalizada).
     */
    public function agregarDetalle(Request $request)
    {
        // Validar que los datos requeridos están presentes en la solicitud
        $request->validate([
            'cita_id' => 'required',
            'servicio_id' => 'required',
            'precio' => 'required|numeric'
        ]);
        try {
            // Buscar la cita por su ID
            $cita = Cita::find($request->cita_id);

            // Verificar si la cita existe y si está finalizada
            if (!$cita || $cita->finalizada) {
                return response()->json('No se puede agregar detalle a esta cita');
            }

            // Crear un nuevo detalle de cita con los datos recibidos
            $detalle = new Detalle_cita();
            $detalle->cita_id = $request->cita_id;
            $detalle->servicio_id = $request->servicio_id;
            $detalle->precio = $request->precio;

            // Guardar el detalle en la base de datos
            $detalle->save();

            // Devolver un mensaje de éxito
            return response()->json('Detalle agregado correctamente');
        } catch (\Throwable $th) {
            // Capturar cualquier error y devolverlo en formato JSON
            return response()->json('Error: ' . $th->getMessage());
        }
    }

    /**
     * Borrar un detalle de una cita (solo si no está finalizada).
     */
    public function borrarDetalle($id)
    {
        try {
            // Buscar el detalle por su ID
            $detalle = Detalle_cita::find($id);

            // Verificar si el detalle existe y si la cita asociada está finalizada
            if (!$detalle || $detalle->cita->finalizada) {
                return response()->json('No se puede eliminar este detalle');
            }

            // Eliminar el detalle de la base de datos
            $detalle->delete();

            // Devolver un mensaje de éxito
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
            // Buscar la cita por su ID
            $cita = Cita::find($id);

            // Verificar si la cita existe y si tiene detalles asociados
            if (!$cita || $cita->detalle_citas()->count() > 0) {
                return response()->json('No se puede eliminar esta cita');
            }

            // Eliminar la cita de la base de datos
            $cita->delete();

            // Devolver un mensaje de éxito
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
            // Buscar la cita por su ID
            $cita = Cita::find($id);

            // Verificar si la cita existe
            if (!$cita) {
                return response()->json('Cita no encontrada');
            }

            // Marcar la cita como finalizada
            $cita->finalizada = true;

            // Guardar los cambios en la base de datos
            $cita->save();

            // Devolver un mensaje de éxito
            return response()->json('Cita finalizada correctamente');
        } catch (\Throwable $th) {
            return response()->json('Error: ' . $th->getMessage());
        }
    }
}
