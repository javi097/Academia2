@extends('plantillas.plantilla')
@section('titulo')
    Academia S.A.
@endsection
@section('cabecera')
    Calificaciones del Alumno: {{$alumno->nombre.', '.$alumno->apellidos}}
@endsection
@section('contenido')
    <form name="cal" method="POST" action="{{route('alumnos.calificar')}}">
        @csrf
        <input type="hidden" name="id_al" value="{{$alumno->id}}"/>
            @foreach ($alumno->modulos as $modulo)
                <label for="{{$modulo->id}}" class="col-sm-1 col-form-label text-weight-bold">{{$modulo->nombre}}</label>
                <div class="col-sm-2">
                    <input type="number" id="{{$modulo->id}}" name="modulos[{{$modulo->id}}]"
                    class="form-control" value="{{$modulo->pivot->nota}}" max="10" min="0" step="0.01" maxlength="4">
                </div>    
            @endforeach
            <div class="form-group-row mt-3">
                <input type="submit" value="Calificar" class="btn btn-info mr-3">
                <a href="{{route('alumnos.show', $alumno)}}" class="ml-3 btn btn-primary">Volver</a>
            </div>
    </form>
@endsection