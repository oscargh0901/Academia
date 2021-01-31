@extends('plantillas.plantilla')
@section('titulo')
academia
@endsection
@section('cabecera')
Editar alumno
@endsection
@section('contenido')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('alumnos.update', $alumno)}}" method="POST">
@csrf
@method('PUT')
    <div class="mt-3" style="font-weight: bold">
    <div class="col">
        <label class="ml-3 col-form-label">Nombre</label>
        <input type="text" class="form-control" value="{{$alumno->nombre}}" placeholder="Nombre">
    </div>
    <div class="col">
        <label class="ml-3 col-form-label">Apellidos</label>
        <input type="text" class="form-control" value="{{$alumno->apellido}}" placeholder="Apellidos">
    </div>
    <div class="col">
        <label class="ml-3 col-form-label">Mail</label>
        <input type="mail" class="form-control" value="{{$alumno->mail}}" placeholder="mail">
    </div>
    <div class="col">
        <label class="ml-3 col-form-label">Foto</label>
        <input type="file" class="form-control" value="{{$alumno->foto}}" accept="image/*">
    </div>
    <div class="col">
        <label class="ml-3 col-form-label">Telefono</label>
        <input type="text" class="form-control" value="{{$alumno->telefono}}" placeholder="telefono">
    </div>
    <div class="float-right"><img src="{{asset($alumno->foto)}}" width='80px' height='80px' class="img-fluid rounded-circle"></div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <input type="submit" class="btn btn-info normal" value="Editar">
            <input type="reset" class="btn btn-danger normal">
        <a href="{{route('alumnos.index')}}" class="btn btn-success">Volver</a>
        </div>
    </div>
</form>
@endsection
