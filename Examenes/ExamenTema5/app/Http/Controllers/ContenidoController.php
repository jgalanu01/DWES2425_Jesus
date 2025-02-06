<?php

namespace App\Http\Controllers;

use App\Models\Contenido;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContenidoController extends Controller
{
    
    public function index()
    {

        try {
            $contenidos = Contenido::all();     
            return response()->json($contenidos);
        } catch (\Throwable $th) {

            return response()->json(['Error'.$th->getMessage()],500);
        }
        
    }

    
    public function store(Request $request)
    {
        
    }

  
    public function show(Contenido $contenido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contenido $contenido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contenido $contenido)
    {
        //
    }
}
