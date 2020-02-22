@extends('plantillas.plantilla')
@section('titulo')
    Academia S.A.
@endsection
@section('cabecera')
    Detalles Alumno
@endsection
@section('contenido')
@if ($text=Session::get('mensaje'))
    <p class="alert alert-info my-3">{{$text}}</p>
@endif
    <span class="clearfix"></span>
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 48rem;">
        <div class="card-header text-center"><b>{{($alumno->nombre)}}</b></div>
        <div class="card-body" style="font-size: 1.1em">
            <h5 class="card-title text-center">{{($alumno->id)}}</h5>
            <p class="card-text">
            <div class="float-right"><img src="{{asset($alumno->logo)}}" width="160px" heght="160px" class="rounded-circle"></div>
            <p><b>Nombre:</b> {{$alumno->nombre.', '.$alumno->apellidos}}</p>
            <p><b>Mail:</b> {{$alumno->mail}}</p>
            <p><b>Módulos:</b>
                <ul>
                    @foreach ($alumno->modulos as $modulo)
                        <li>{{$modulo->nombre.' ('.$modulo->pivot->nota.')'}}</li>
                    @endforeach
                </ul>
            </p>
            </p>
            <p class="card-text">
                <p>Nota Media de {{$alumno->nombre}}</p>
                <ul>
                @if ($alumno->notaMedia()!="Sin nota")
                    <li>{{$alumno->notaMedia()}}</li>
                @endif
                </ul>
            </p>
            <a href="{{route('alumnos.index')}}" class="float-right btn btn-success my-3">Volver</a>
            <a href="{{route('alumnos.fmatricula', $alumno)}}" class="btn btn-primary float-right mr-3 my-3">Matricular Alumno</a>
            <a href="{{route('alumnos.fcalificar', $alumno)}}" class="btn btn-danger float-right mr-3 my-3">Calificar Alumno</a>            
        </div>
    </div>
@endsection