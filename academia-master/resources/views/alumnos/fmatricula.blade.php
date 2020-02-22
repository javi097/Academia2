@extends('plantillas.plantilla')
@section('titulo')
    Academia S.A.
@endsection
@section('cabecera')
    Módulos disponibles para el alumno {{$alumno->nombre.', '.$alumno->apellidos}}
@endsection
@section('contenido')
    <form name="matriculas" method="POST" action="{{route('alumnos.matricular')}}">
        @csrf
        <input type="hidden" value="{{$alumno->id}}" name="alumno_id">
        <div class="form-row">
            <select class="form-control" name="modulo_id[]" multiple>
                @foreach ($modulos2 as $modulo)
                    <option value="{{$modulo->id}}">{{$modulo->nombre." (".$modulo->horas.")"}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-row">
            <div class="col mt-3">
                <input type="submit" value="Matricular" class="btn btn-info mr-3">
                <a href="{{route('alumnos.show', $alumno)}}" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </form>
@endsection