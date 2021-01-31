@extends('plantillas.plantilla')
@section('titulo')
academia
@endsection
@section('cabecera')
Crear alumno
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
<div>
<div>
<form action="{{route('alumnos.store')}}" method='POST' enctype="multipart/form-data">
    @csrf
    <div class="mt-3" style="font-weight: bold">
        <div class="col">
            <label class="ml-3 col-form-label">Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre">
        </div>
        <div class="col">
            <label class="ml-3 col-form-label">Apellidos</label>
            <input type="text" class="form-control" placeholder="Apellidos">
        </div>
        <div class="col">
            <label class="ml-3 col-form-label">Mail</label>
            <input type="mail" class="form-control" placeholder="mail">
        </div>
        <div class="col">
            <label class="ml-3 col-form-label">Foto</label>
            <input type="file" class="form-control" accept="image/*">
        </div>
        <div class="col">
            <label class="ml-3 col-form-label">Telefono</label>
            <input type="text" class="form-control" placeholder="telefono">
        </div>
    </div>
    <div class="mt-3">
        <div>
            <input type="submit" value="Crear" class="btn btn-success mr-3">
            <input type="reset" value="Limpiar" class="btn btn-warning mr-3">
        <a href="{{route('alumnos.index')}}" class="btn btn-info">Volver</a>
        </div>
    </div>
</form>
</div>
</div>
@endsection
