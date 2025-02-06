<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contenido;
use App\Models\Reproduccion;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use function PHPSTORM_META\map;

class ReproduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        
        $request->validate([
            'email' => 'required',
            'contenido_id' => 'required',
            'fechaIR'=>'required',
            'cliente_id'=>'required',
            'contenido_id'=>'required'

        ]);
        try {
          
            $cliente = Cliente::find();
            $contenido=Contenido::find();

       
            if (!$cliente||!$contenido) {
                return response()->json('No existe o el cliente o el contenido');
            }else{
                $reproduccion = new Reproduccion();
                $reproduccion->fechaIR = $request->fechaIR;
                $reproduccion->cliente_id = $request->cliente_id;
                $reproduccion->contenido_id=$request->contenido_id;


            }
     
            $reproduccion->save();

           
            return response()->json('Reproduccion agregada correctamente');
        } catch (\Throwable $th) {
          
            return response()->json(['Error'.$th->getMessage()],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function obtenerReproducciones($email){
    

    try {
        $cliente=Cliente::find();
        $contenidos=Contenido::find();

        if($cliente && $cliente->email){

            return response()->json($contenidos->reproduccion());

        }
        else{
            return response()->json('Cliente o email no existe');
        }

        }catch(\Throwable $th){
            return response()->json(['Error'.$th->getMessage()],500);
        }
    }

       

     
    /**
     * Display the specified resource.
     */
    public function show(Reproduccion $reproduccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reproduccion $reproduccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reproduccion $reproduccion)
    {
        //
    }
}
