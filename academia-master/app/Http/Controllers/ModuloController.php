<?php

namespace App\Http\Controllers;

use App\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos=Modulo::orderBy('nombre')->paginate(3);
        return view('modulos.index',compact('modulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validaciones genericas
        $request->validate([
            'nombre'=>['required'],
            'horas'=>['required']
        ]);
        //cojo los datos por que voy a modificar el request 
        //voy a poner nom y ape la primera letra en mayusculas
        $modulo=new Modulo();
        $modulo->nombre=ucwords($request->nombre);
        $modulo->horas=ucwords($request->horas);
        $modulo->save();
        
        return redirect()->route('modulos.index')->with("mensaje", "Modulo Guardado");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function show(Modulo $modulo)
    {
        return view('modulos.detalle', compact('modulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modulo $modulo)
    {
        return view('modulos.edit', compact('modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modulo $modulo)
    {
        $request->validate([
            'nombre'=>['required'],
            'horas'=>['required']
        ]);

        $modulo->nombre=ucwords($request->nombre);
        $modulo->horas=ucwords($request->horas);

        //Guardamos el fichero
        $modulo->update($request->all());

        return redirect()->route('modulos.index')->with('mensaje', 'Modulo Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modulo $modulo)
    {
       $modulo->delete();
       return redirect()->route('modulos.index')->with('mensaje', 'Modulo borrado correctamente');
    }
}
