<?php

namespace App\Http\Controllers;

use App\Models\Billete;
use App\Models\Conductor;
use App\Models\Linea;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Exception;


class BilleteController extends Controller
{
   
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function venderBillete (Request $request)
    {
        $request->validate([
            'conductor_id'=>'required',
            'linea_id'=>'required',
            'fecha'=>'required',
            'hora'=>'required',
            'tipo'=>'in:General,Reducido',
            'precio'=>'required'
        ]);
        try{
            $conductor=Conductor::where('conductor_id',$request->conductor_id)->first();
            if($conductor!=null){
                $linea=Linea::find($request->linea_id);
                if($linea!=null){
                    $billete=new Billete();
                    $billete->conductor_id=$conductor->id;
                    $billete->linea_id=$linea->id;
                    $billete->fecha=date('Y-m-d H:i');
                    $billete->hora=$request->hora;
                    $billete->tipo=$request->tipo;
                    $billete->precio=$request->precio;

                    if($billete->save()){
                        return $billete;
                    }
                    


                }else{
                    throw new Exception('La linea no existe');
                }

            }else{
                throw new Exception('El conductor no existe');
            }
        } catch(\Throwable $th){
            return response()->json(['message'=>$th->getMessage()],500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Billete $billete)
    {
        $request->validate([
            'id'=>'required'
        ]);
        $conductor=Conductor::where('id',$request->id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Billete $billete)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billete $billete)
    {
        //
    }
}
