@extends('plantillas.plantilla')
@section('titulo')
    Academia S.A.
@endsection
@section('cabecera')
    Gestión de Alumnos
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
<div class="card-header text-center text-warning h3">Editar Alumno</div>
<div class="card-body">
    <form name="g" action="{{route('alumnos.update', $alumno)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col">
                <label for="nom" class="col-form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value={{$alumno->nombre}} id="nom" required>
            </div>
            <div class="col">
                <label for="apell" class="col-form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value={{$alumno->apellidos}} id="apell" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col  my-3">
                <label for="mail" class="col-form-label">Mail</label>
                <input type="email" class="form-control" name="mail" value={{$alumno->mail}} id="mail" required>
            </div>
            <div class="col my-2">
                <label for="logo" class="col-form-label">Logo</label>
                <img src="{{asset($alumno->logo)}}" width="50px" height="50px" class="rounded-circle">
                <input type="file" class="form-control p-1" name="logo" accept="image/*" id="logo">
            </div>
        </div>
        <div class="form-row text-center mt-3">
            <div class="col">
                <input type="submit" value="Modificar" class="btn btn-success mr-2">
                <a href="{{route('alumnos.index')}}" class="btn btn-danger ml-2">Volver</a>
            </div>
        </div>
    </form>
</div> 
</div>
@endsection