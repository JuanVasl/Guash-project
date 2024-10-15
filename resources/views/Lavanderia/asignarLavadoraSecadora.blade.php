@extends('layauts.base')

@section('title', 'Asignar Lavadora y Secadora')

@section('content')
<div class="container">
    <h4>Asignar Lavadora y Secadora a Pedido: {{ $pedido->id_pedido }}</h4>

    <form action="{{ route('guardarAsignacionLavadoraSecadora', $pedido->id_pedido) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="lavadora">Seleccione una Lavadora:</label>
            <select name="id_lavadora" id="lavadora" class="form-control">
                @foreach($lavadorasDisponibles as $lavadora)
                    <option value="{{ $lavadora->id_maquina }}">{{ $lavadora->modelo }} (Capacidad: {{ $lavadora->capacidad }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="secadora">Seleccione una Secadora:</label>
            <select name="id_secadora" id="secadora" class="form-control">
                @foreach($secadorasDisponibles as $secadora)
                    <option value="{{ $secadora->id_maquina }}">{{ $secadora->modelo }} (Capacidad: {{ $secadora->capacidad }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Iniciar Lavado</button>
        <a href="{{ route('pedidos') }}" class="btn btn-danger">Retroceder</a>
    </form>
</div>
@endsection
