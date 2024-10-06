@extends('layauts.base') 
@section('title', 'Detalle Lavadora')
@section('content')

<!-- Título -->
<div class="container">
    <div class="col-12">
        <h3 class="text-center"><strong>Detalles de Lavadora</strong></h3>
    </div>
</div>

<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
            <div class="text-center">
                <h5><strong>Lavadora ID: {{ $lavadora->id_maquina }}</strong></h5>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label><strong>Modelo:</strong></label>
                <p>{{ $lavadora->modelo }}</p>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label><strong>Marca:</strong></label>
                <p>{{ $lavadora->marca }}</p>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label><strong>Serie:</strong></label>
                <p>{{ $lavadora->serie }}</p>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label><strong>Capacidad (LBS):</strong></label>
                <p>{{ $lavadora->capacidad }}</p>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label><strong>Estado Actual:</strong></label>
                <p>{{ $lavadora->nombre_estado }}</p>
            </div>

            <!-- Formulario para cambiar el estado de la lavadora -->
            <form id="estadoLavadoraForm" action="{{ route('actualizarEstadoLavadora', $lavadora->id_maquina) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="estado"><strong>Cambiar Estado:</strong></label>
                    <select name="estado_id_estado" id="estado" class="form-control">
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id_estado }}" {{ $estado->id_estado == $lavadora->estado_id_estado ? 'selected' : '' }}>
                                {{ $estado->estado }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="links mt-3">
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <a href="/lavadoras" class="btn btn-danger">Retroceder</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
