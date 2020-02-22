@extends('plantillas.plantilla')
@section('titulo')
    Academia S.A.
@endsection
@section('cabecera')
    Gestión de Modulos
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
<div class="card-header text-center text-warning h3">Editar Modulos</div>
<div class="card-body">
    <form name="g" action="{{route('modulos.update', $modulo)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col">
                <label for="nom" class="col-form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value={{$modulo->nombre}} id="nom" required>
            </div>
            <div class="col">
                <label for="h" class="col-form-label">Horas</label>
                <input type="text" class="form-control" name="horas" value={{$modulo->horas}} id="h" required>
            </div>
        </div>
        <div class="form-row text-center mt-3">
            <div class="col">
                <input type="submit" value="Modificar" class="btn btn-success mr-2">
                <a href="{{route('modulos.index')}}" class="btn btn-danger ml-2">Volver</a>
            </div>
        </div>
    </form>
</div> 
</div>
@endsection