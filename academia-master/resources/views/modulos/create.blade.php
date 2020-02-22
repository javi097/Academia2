@extends('plantillas.plantilla')
@section('titulo')
Academia s.a.
@endsection
@section('cabecera')

@endsection
@section('contenido')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $miError)
            <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card bg-secondary">
    <div class="card-header text-center text-white h3">Guardar Modulo</div>
    <div class="card-body">
    <form name="g" action="{{route('modulos.store')}}" method='POST' enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col">
                <label for="nom" class="col-form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre"  placeholder="Nombre" id="nom" required>
            </div>
            <div class="col">
                <label for="ape" class="col-form-label">Horas</label>
                <input type="text" name="horas" class="form-control" placeholder="Horas" id="h" required>
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="col">
                <input type="submit" value="Crear" class="btn btn-success mr-3">
                <input type="reset" value="Limpiar" class="btn btn-warning mr-3">
            <a href="{{route('modulos.index')}}" class="btn btn-info">Volver</a>   

    </form>
    </div>
</div>
@endsection