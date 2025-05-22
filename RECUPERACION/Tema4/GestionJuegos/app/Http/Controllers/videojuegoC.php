<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videojuego;
use Exception;

class videojuegoC extends Controller
{
    function inicioM(){

        $juegos=Videojuego::orderBy('nombre')->get();
        return view('vistaJuegos',compact('juegos'));
    }

    function nuevoJuegoM(){
        return view('crearVideojuego');
    }

    function crearJuegoM(Request $request){
        $request->validate(['nombre' => 'required', 'plataforma' => 'required','precio'=>'required|numeric|min:1','stock'=>'required|numeric|min:0']);

        try {
            $juego=new Videojuego();
            $juego->nombre=$request->nombre;
            $juego->plataforma=$request->plataforma;
            $juego->precio=$request->precio;
            $juego->stock=$request->stock;

            if($juego->save()){
                return back()->with('mensaje','Videojuego creado');
            }else{
                throw new Exception ('No se ha podido crear el juego');
            }

        } catch (\Throwable $th) {
            return back()->with('mensaje',$th->getMessage());
        }
    }

    function editarJuegoM($id){

    $juego = Videojuego::find($id);
    return view('editarVideojuego', compact('juego'));
}

function actualizarJuegoM(Request $request, $id){
    $request->validate([
        'nombre' => 'required',
        'plataforma' => 'required',
        'precio' => 'required|numeric|min:1',
        'stock' => 'required|numeric|min:0'
    ]);

    try {
        $juego = Videojuego::find($id);

        if ($juego == null) {
            return back()->with('mensaje', 'El videojuego no existe');
        }

        $juego->nombre = $request->nombre;
        $juego->plataforma = $request->plataforma;
        $juego->precio = $request->precio;
        $juego->stock = $request->stock;

        if ($juego->save()) {
            return redirect()->route('rInicio')->with('mensaje', 'Videojuego actualizado correctamente');
        } else {
            throw new \Exception('No se ha podido actualizar el videojuego');
        }

    } catch (\Throwable $th) {
        return back()->with('mensaje', $th->getMessage());
    }

}

function borrarJuegoM($id){
    $juego=Videojuego::find($id);

    try {
        if($juego==null){
            return back()->with('mensaje','El videojuego no existe');
        }
        $juego->delete();
        return back()->with('mensaje','Juego borrado con exito');
    } catch (\Throwable $th) {
       return back()->with('mensaje',$th->getMessage());
    }

   
    
}

}
