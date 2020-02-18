<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Modulo;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos=Alumno::orderBy('apellidos')->paginate(4);
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
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
            'apellidos'=>['required'],
            'mail'=>['required', 'unique:alumnos,mail']
        ]);
        //cojo los datos por que voy a modificar el request 
        //voy a poner nom y ape la primera letra en mayusculas
        $alumno=new Alumno();
        $alumno->nombre=ucwords($request->nombre);
        $alumno->apellidos=ucwords($request->apellidos);
        $alumno->mail=$request->mail;
        //Comprobamos si hemos subido unn logo
        if($request->has('logo')){
            $request->validate([
                'logo'=>['image']
            ]);
            $file=$request->file('logo');
            $nom='logo/'.time().'_'.$file->getClientOriginalName();
            //Guardamos el fichero en public
            \Storage::disk('public')->put($nom, \File::get($file));
            //le damos a alumno en nombre que le hemos puesto al fichero
            $alumno->logo="img/$nom";
            //Guardamos el alumno
            } 
        $alumno->save();
        
        return redirect()->route('alumnos.index')->with("mensaje", "Alumno Guardado");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        return view('alumnos.detalle', compact('alumno'));
    }
    public function fmatricula(Alumno $alumno){
       $modulos2=$alumno->modulosOut();
        //compruebo si ya los tiene todos
        if($modulos2->count()==0){
            return redirect()->route('alumnos.show', $alumno)
            ->with('mensaje', 'Este alumno ya está matriculado de todos los módulos');
        }
        //cargamos el formulario matricular alumno le mando el alumno y los modulos que le faltan
        return view('alumnos.fmatricula', compact('alumno', 'modulos2'));
    }
    public function matricular(Request $request){
            $id=$request->alumno_id;
            //me traigo el alumno de código id
            $alumno=Alumno::find($id);
            if(isset($request->modulo_id)){
                foreach($request->modulo_id as $item){
                    $alumno->modulos()->attach($item);
                }
                return redirect()->route('alumnos.show', $alumno)->with("mensaje", "Alumno Matriculado");

            }
            return redirect()->route('alumnos.show', $alumno)->with("mensaje", "Ningun Módulo selecionado");

    }
    //--------------------------------------------------------------
    public function fcalificar(Alumno $alumno){
        $modulos=$alumno->modulos()->get();
        if($modulos->count()==0){
            return redirect()->route('alumnos.show', $alumno)->with("mensaje", "El alumno no cursa Ningún módulo");
        }

        return view('alumnos.fcalificar', compact('alumno'));
    }
    public function calificar(Request $request){
           // dd($request->modulos);
           $alumno=Alumno::find($request->id_al);
           //recorro el array asociativo con losid modulos y las notas
           foreach($request->modulos as $k=>$v){
               $alumno->modulos()->updateExistingPivot($k, ['nota'=>$v]);
           }

           return redirect()->route('alumnos.show', $alumno)->with("mensaje", "Calificaciones Guardadas");
    }
    //------------------------------------------------------------------
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //
    }
}
