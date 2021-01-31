@extends('plantillas.plantilla')
@section('titulo')
academia
@endsection
@section('cabecera')
Academia S.L.
@endsection
@section('contenido')
@if($text=Session::get('mnesaje'))
<p class="alert alert-danger my-3">{{$text}}</p>
@endif
<table class="table table-striped table-dark">
<thead>
    <tr>
    <th scope="col" class="align-middle">Nombre</th>
    <th scope="col" class="align-middle">Apellidos</th>
    <th scope="col" class="align-middle">Mail</th>
    <th scope="col" class="align-middle">telefono</th>
    <th scope="col" class="align-middle">Imagen</th>
    </tr>
</thead>

<tbody>
    @foreach($alumnos as $alumno)
    <tr class="align-middle">
    <td class="align-middle">{{$alumno->nombre}}</td>
    <td class="align-middle">{{$alumno->apellidos}}</td>
    <td class="align-middle">{{$alumno->mail}}</td>
    <td class="align-middle">{{$alumno->telefono}}</td>
    <td class="align-middle">
    <img src="{{asset($alumno->foto)}}" width='77px' height='77px' class="img-fluid rounded-circle">
    </td>
    <td class="align-middle" style="white-space: :nowrap">
        <form class="form-inline" action="{{route('alumnos.destroy', $alumno)}}" method='POST'>
        @method("DELETE")
        @csrf
        <button type="submit" class="ml-2 btn btn-danger">Borrar</button>
        <a href="{{route('alumnos.edit', $alumno)}}" class="ml-2 btn btn-warning">Editar</a>
        <a href="{{route('alumnos.create')}}" class="ml-2 btn btn-info">Crear alumno</a>
        </form>
    </td>
    </tr>
    @endforeach
</tbody>
</table>
{{$alumnos->links()}}
@endsection
