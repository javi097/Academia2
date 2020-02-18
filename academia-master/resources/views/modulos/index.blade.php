@extends('plantillas.plantilla')
@section('titulo')
Academia s.a.
@endsection
@section('cabecera')
Gestion de Alumnos
@endsection
@section('contenido')
@if($text=Session::get('mnesaje'))
<p class="alert alert-danger my-3">{{$text}}</p>
@endif
<a href="{{route('modulos.create')}}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Crear Modulo</a>
<table class="table table-striped table-dark">
    <thead>
      <tr>
        <th scope="col">Detalles</th>
        <th scope="col" class="align-middle">Nombre</th>
        <th scope="col" class="align-middle">Horas</th>
        <th scope="col" class="align-middle">Acciones</th>
      </tr>
    </thead>
    <tbody>
        @foreach($modulos as $modulo)
      <tr class="align-middle">
        <th scope="row" class="align-middle">
        <a href="{{route('modulos.show', $modulo)}}" class="btn btn-success fa fa-address-card fa-2x"><i class=""></i></a>
        </th>
      <td class="align-middle">{{$modulo->nombre}}</td>
      <td class="align-middle">{{$modulo->horas}}</td>
       <td class="align-middle" style="white-space: :nowrap">
          <form class="form-inline" name="del" action="{{route('modulos.destroy', $modulo)}}" method='POST'>
            @method("DELETE")
            @csrf
            <button type="submit" onclick="return confirm('¿Borrar Modulo?')" class="btn btn-danger fa fa-trash fa-2x"></button>
            <a href="{{route('modulos.edit', $modulo)}}" class="ml-2 fa fa-edit fa-2x btn btn-warning"></a>
          </form>  
      </td>   
      </tr>
      @endforeach
    </tbody>
  </table>
  {{$modulos->links()}}
  
@endsection