@extends('layauts.base') 
@section('title', 'Nueva Lavadora')
@section('content')

<!-- Título -->
<div class="container">
        <div class="col-12">
            <h3 class="text-start"><strong>Nueva Lavadora</strong></h3>
        </div>
    </div>

    <!-- Formulario central -->
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="btn-container mt-2 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
            <form action="{{ route('lavadora.save') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" name="marca" id="marca" class="form-control" value="{{ old('marca') }}" required>
            @error('marca')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="modelo" class="form-control" value="{{ old('modelo') }}" required>
            @error('modelo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="serie">Serie:</label>
            <input type="text" name="serie" id="serie" class="form-control" value="{{ old('serie') }}" required>
            @error('serie')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="capacidad">Capacidad (Lbs):</label>
            <input type="number" name="capacidad" id="capacidad" class="form-control" value="{{ old('capacidad') }}" required>
            @error('capacidad')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mt-2">Agregar</button>
        <a href="/equiposLavanderia/lavadoras" class="btn btn-danger mt-2">Cancelar</a>    

@endsection
