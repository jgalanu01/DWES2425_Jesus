<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RecursoController extends Controller
{
    /**
     * Obtener todos los recursos.
     */
    public function index()
    {
        try {
            // Obtener todos los recursos
            $recursos = Recurso::all();
            return response()->json($recursos, 200);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage()], 500);
        }
    }

    /**
     * Crear un nuevo recurso.
     */
    public function store(Request $request)
    {
        // Validación de los datos del recurso
        $request->validate([
            'nombre' => 'required|string',  // Nombre del recurso
            'tipo' => 'required|string', // Tipo de recurso
        ]);

        try {
            // Crear el nuevo recurso
            $recurso = new Recurso();
            $recurso->nombre = $request->nombre;
            $recurso->tipo = $request->tipo;

            // Guardar el recurso
            if ($recurso->save()) {
                return response()->json(['message' => 'Recurso creado exitosamente'], 201);
            }

            return response()->json(['message' => 'Error al crear el recurso'], 500);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage()], 500);
        }
    }

    /**
     * Actualizar un recurso existente.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos del recurso
        $request->validate([
            'nombre' => 'required|string',  // Nombre del recurso
            'tipo' => 'required|string', // Tipo de recurso
        ]);

        try {
            // Encontrar el recurso por ID
            $recurso = Recurso::find($id);

            if (!$recurso) {
                return response()->json(['message' => 'Recurso no encontrado'], 404);
            }

            // Actualizar el recurso
            $recurso->nombre = $request->nombre;
            $recurso->tipo = $request->tipo;

            // Guardar el recurso actualizado
            if ($recurso->save()) {
                return response()->json(['message' => 'Recurso actualizado exitosamente'], 200);
            }

            return response()->json(['message' => 'Error al actualizar el recurso'], 500);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage()], 500);
        }
    }

    /**
     * Eliminar un recurso existente.
     */
    public function destroy($id)
    {
        try {
            // Encontrar el recurso por ID
            $recurso = Recurso::find($id);

            if (!$recurso) {
                return response()->json(['message' => 'Recurso no encontrado'], 404);
            }

            // Eliminar el recurso
            $recurso->delete();

            return response()->json(['message' => 'Recurso eliminado exitosamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage()], 500);
        }
    }
}
