@extends('layauts.base')

@section('title', 'Lavado en Proceso')

@section('content')
<div class="container text-center mt-5">
    <h4>Bienvenido(a), {{ Auth::user()->name }}</h4> <!-- Mostramos el nombre del usuario logueado -->

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Procesando...</h5>

            <div class="mt-4">
                <img src="https://via.placeholder.com/150?text=✓" alt="Lavado Completado" class="img-fluid" style="max-width: 150px;">
                <h3 class="mt-3">¡Listo!</h3>
            </div>

            <div class="mt-4">
                <a href="{{ route('solicitarMotorista', $pedido->id_pedido) }}" class="btn btn-secondary">Solicita Motorista</a>
            </div>
        </div>
    </div>
</div>
@endsection
