<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class prestamoC extends Controller
{
    function prestamosM(){
        $prestamos=Prestamo::orderBy('fecha','ASC')->get();

        return view('verPrestamos',compact('prestamos'));
    }

    function crearPrestamoM(){
        $libros=Libro::all();
        return view('crearPrestamos',compact('libros'));
    }

    function insertarPrestamoM(Request $request){
        $request->validate([
            'fecha' => 'required',
            'libro' => 'required',
            'cliente' => 'required'
        ]);
    
        try {
            DB::transaction(function () use ($request) {
    
                $l = Libro::find($request->libro);
    
                if ($l && $l->numEjemplares > 0) {
    
                    $p = Prestamo::where('nombreCliente', $request->cliente)
                                 ->whereNull('fechaDevolucion')
                                 ->first();
    
                    if ($p == null) {
                        $prestamo = new Prestamo();
                        $prestamo->fecha = $request->fecha;
                        $prestamo->libro_id = $l->id;
                        $prestamo->nombreCliente = $request->cliente;
    
                        if ($prestamo->save()) {
                            $l->numEjemplares--;
                            $l->save();
                        } else {
                            throw new Exception('No se ha podido guardar el préstamo');
                        }
                    } else {
                        throw new Exception('El cliente ya tiene un libro sin devolver');
                    }
                } else {
                    throw new Exception('No hay ejemplares disponibles de ese libro');
                }
            });
    
            return redirect()->route('prestamosR')->with('mensaje', 'Préstamo registrado correctamente');
    
        } catch (\Throwable $th) {
            return back()->with('mensaje', $th->getMessage());
        }
    }
}
