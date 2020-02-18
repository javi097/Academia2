@extends('plantillas.plantilla')
@section('titulo')
Academia s.a.
@endsection
@section('cabecera')
Calificaciones de: {{$alumno->nombre. ", ".$alumno->apellidos}}
@endsection
@section('contenido')
<form name='cal' method='POST' action="{{route('alumnos.calificar')}}">
    @csrf
<input type='hidden' name="id_al" value="{{$alumno->id}}" />
    @foreach($alumno->modulos as $modulo)
    <div class="form-group row">
    <label for="{{$modulo->id}}" 
        class="col-sm-1 col-form-label text-primary text-weight-bold">{{$modulo->nombre}}</label>
        <div class="col-sm-2">
        <input type='number' id="{{$modulo->id}}" name="modulos[{{$modulo->id}}]" class="form-control"
        value="{{$modulo->pivot->nota}}" max="10" min="0" step="0.01" maxlength="4">
        </div>
    </div>
    @endforeach
    <div class="mt-3 form-group row">
    <input type='submit' value='Calificar' class='btn btn-warning'>
    <a href="{{route('alumnos.show' , $alumno)}}" class=" ml-3 btn btn-primary">Volver</a>
    </div>
</form>
@endsection