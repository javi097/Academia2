@extends('plantillas.plantilla')
@section('titulo')
    Academia S.A.
@endsection
@section('cabecera')
    Gestión de Alumnos
@endsection
@section('contenido')
@if ($text=Session::get('mensaje'))
    <p class="alert alert-danger my-3">{{$text}}</p>
@endif
<a href="{{route('alumnos.create')}}" class="btn btn-info mb-3"><i class="fa fa-plus mr-2"></i>Crear Alumno</a>
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">Detalles</th>
            <th scope="col" class="align-middle">Apellidos, Nombre</th>
            <th scope="col" class="align-middle">Mail</th>
            <th scope="col" class="align-middle">Imagen</th>
            <th scope="col" class="align-middle">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <th scope="row">
                        <a href="{{route('alumnos.show', $alumno)}}" class="btn btn-primary fa fa-address-card fa-3x ">
                        </a>
                    </th>
                    <td class="align-middle">{{$alumno->apellidos.', '.$alumno->nombre}}</td>
                    <td class="align-middle">{{$alumno->mail}}</td>
                    <td class="align-middle">
                        <img src="{{asset($alumno->logo)}}" width="80px" height="80px" class="img-fluid rounded-circle">
                    </td>
                    <td class="align-middle">
                    <form class="form-inline" name="del" action="{{route('alumnos.destroy', $alumno)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Borrar Alumno?')" class="btn btn-danger fa fa-trash fa-2x"></button>
                        <a href="{{route('alumnos.edit', $alumno)}}" class="btn btn-warning fa fa-edit fa-2x ml-3"></a>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$alumnos->links()}}
@endsection