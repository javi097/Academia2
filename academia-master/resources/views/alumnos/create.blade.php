@extends('plantillas.plantilla')
@section('titulo')
    Academia S.A.
@endsection
@section('cabecera')
    Nuevo Alumno
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
    <div class="card-header text-center text-warning h3">Guardar Alumno</div>
    <div class="card-body">
        <form name="g" action="{{route('alumnos.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col">
                    <label for="nom" class="col-form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nom" required>
                </div>
                <div class="col">
                    <label for="apell" class="col-form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" id="apell" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="mail" class="col-form-label">Mail</label>
                    <input type="email" class="form-control" name="mail" placeholder="Email" id="mail" required>
                </div>
                <div class="col">
                    <label for="logo" class="col-form-label">Logo</label>
                    <input type="file" class="form-control p-1" name="logo" accept="image/*" id="logo">
                </div>
            </div>
            <div class="form-row text-center mt-3">
                <div class="col">
                    <input type="submit" value="Crear" class="btn btn-success mr-2">
                    <input type="reset" value="Limpiar" class="btn btn-warning mr-2 ml-2">
                    <a href="{{route('alumnos.index')}}" class="btn btn-danger ml-2">Volver</a>
                </div>
            </div>
        </form>
    </div> 
</div>
@endsection