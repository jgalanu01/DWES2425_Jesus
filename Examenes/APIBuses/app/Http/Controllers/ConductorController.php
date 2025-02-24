<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ConductorController extends Controller
{
  
    public function crearConductor(Request $request)
    {
        $request->validate([
            'nombreApe'=>'required',
            'dni'=>'required'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $conductor=Conductor::find($request->crearConductor);
                if($conductor!==null){
                    $conductor=new Conductor();
                    $conductor->dni->$request->dni;
                    $conductor->nombreApe->$request->nombreApe;
                    $conductor->fechaContrato=date('Y-m-d H:i');
                    if($conductor->save()){
                        return $conductor;
                    }else{
                        throw new Exception('El conductor no ha sido creado');

                    }
                }
                
            });

            return response()->json ('Conductor creado',200);
            
        } catch (\Throwable $th) {
            return response()->json(['Error'.$th->getMessage()],500);
        }
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Conductor $conductor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conductor $conductor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conductor $conductor)
    {
        //
    }
}
