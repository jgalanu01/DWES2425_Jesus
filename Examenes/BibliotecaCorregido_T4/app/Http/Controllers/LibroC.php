<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibroC extends Controller
{
    //Importar de cada class el app/models
    function verPrestamos()
    {
        //Nombre de la variable del foreach
        $prestamos = Prestamo::orderBy('fecha', 'DESC')->get();
        return view('verPrestamos', compact('prestamos'));
    }
    
    function insertarPrestamo(){
        $libros = Libro::all();
        return view('insertarP',compact('libros'));
    }

    function cargarPrestamo($id){
        $prestamo = Prestamo::find($id);
        //cargarP nombre de la nueva blade/view
        return view('cargarP',compact('prestamo'));
    }

    function modificarPrestamo(Request $request, $id)
    {
        try {
            DB::transaction(function ()use ($id,$request) {
                    
                    $pres = Prestamo::find($id);
                    $pres->fecha = $request->fecha;
                    $pres->nombreCliente = $request->cliente;
                    $pres->fechaDevolucion = $request->fechaD;
                    if($pres->save()){
                        $pres->libro->numEjemplares++;
                        $pres->libro->save();
                    }
            });
            return redirect()->route('verP')->with('mensaje','Prestamo cerrado');
        } catch (\Throwable $th) {
            return back()->with('mensaje',$th->getMessage());
        }
    }

    function crearPrestamo(Request $request)
    {
        //Validar
        //Lo de la izquierda debe coincider con los names del formulario
        $request->validate([
            "fecha" => "required",
            "libro" => "required",
            "cliente" => "required"
        ]);
        //Busca en la tabla libros el libro por el id mandado
        $idLibro = $request->libro;
        $libro = Libro::find($idLibro);
        if ($libro->numEjemplares > 0) {
            $prestamosCliente = Prestamo::where('nombreCliente',$request->cliente)->where('fechaDevolucion',null)->first();
            if ($prestamosCliente==null) {
            //Importar /facades
            try {
                DB::transaction(function () use($libro,$request) {
                        //Crear pedido
                        $pres = new Prestamo();
                        $pres->fecha = $request->fecha;
                        $pres->libro_id = $request->libro;
                        $pres->nombreCliente = $request->cliente;
                        if($pres->save()){
                            //Modificar stock del producto
                            $libro->numEjemplares--;
                            $libro->save();
                        }
                });
                return redirect()->route('verP')->with('mensaje','Prestamo creado');
            } catch (\Throwable $th) {
                return back()->with('mensaje',$th->getMessage());
            }
        }else {
            return back()->with('mensaje', 'Error, tienes prestamos sin devolver');
        }
    }else {
        return back()->with('mensaje', 'Error, no hay ejemplares');
    }
    }

}

