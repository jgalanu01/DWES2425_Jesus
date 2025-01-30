<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReservaController extends Controller
{
    /**
     * Obtener todas las reservas existentes.
     */
    public function index()
    {
        try {
            // Obtener todas las reservas
            $reservas = Reserva::all();
            return response()->json($reservas, 200);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage()], 500);
        }
    }

    /**
     * Crear una nueva reserva para un recurso.
     */
    public function store(Request $request)
    {
        // Validación de los datos de la reserva
        $request->validate([
            'empleado' => 'required|string',  // Nombre o ID del empleado
            'fechaI' => 'required|date', // Fecha de inicio de la reserva
            'fechaF' => 'required|date', // Fecha de fin de la reserva
            'recurso_id' => 'required|exists:recursos,id', // Asegurarse de que el recurso existe
        ]);

        try {
            // Crear la nueva reserva
            $reserva = new Reserva();
            $reserva->empleado = $request->empleado;
            $reserva->fechaI = $request->fechaI;
            $reserva->fechaF = $request->fechaF;
            $reserva->recurso_id = $request->recurso_id;

            // Guardar la reserva
            if ($reserva->save()) {
                return response()->json(['message' => 'Reserva creada exitosamente'], 201);
            }

            return response()->json(['message' => 'Error al crear la reserva'], 500);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage()], 500);
        }
    }

    /**
     * Actualizar una reserva existente.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos de la reserva
        $request->validate([
            'empleado' => 'required|string',  // Nombre o ID del empleado
            'fechaI' => 'required|date', // Fecha de inicio de la reserva
            'fechaF' => 'required|date', // Fecha de fin de la reserva
            'recurso_id' => 'required|exists:recursos,id', // Asegurarse de que el recurso existe
        ]);

        try {
            // Encontrar la reserva por ID
            $reserva = Reserva::find($id);

            if (!$reserva) {
                return response()->json(['message' => 'Reserva no encontrada'], 404);
            }

            // Actualizar la reserva
            $reserva->empleado = $request->empleado;
            $reserva->fechaI = $request->fechaI;
            $reserva->fechaF = $request->fechaF;
            $reserva->recurso_id = $request->recurso_id;

            // Guardar la reserva actualizada
            if ($reserva->save()) {
                return response()->json(['message' => 'Reserva actualizada exitosamente'], 200);
            }

            return response()->json(['message' => 'Error al actualizar la reserva'], 500);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage()], 500);
        }
    }

    /**
     * Eliminar una reserva existente.
     */
    public function destroy($id)
    {
        try {
            // Encontrar la reserva por ID
            $reserva = Reserva::find($id);

            if (!$reserva) {
                return response()->json(['message' => 'Reserva no encontrada'], 404);
            }

            // Eliminar la reserva
            $reserva->delete();

            return response()->json(['message' => 'Reserva eliminada exitosamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage()], 500);
        }
    }
}
