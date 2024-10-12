@extends('layauts.base')

@section('title', 'Asignar Lavadora')

@section('content')
<div class="container">
    <h4>Asignar Lavadora a Pedido: {{ $pedido->id_pedido }}</h4>

    <form action="{{ route('guardarAsignacionLavadora', $pedido->id_pedido) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="lavadora">Seleccione una Lavadora:</label>
            <select name="id_lavadora" id="lavadora" class="form-control">
                @foreach($lavadorasDisponibles as $lavadora)
                    <option value="{{ $lavadora->id_maquina }}">{{ $lavadora->modelo }} (Capacidad: {{ $lavadora->capacidad }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Asignar Lavadora</button>
        <a href="{{ route('pedidos') }}" class="btn btn-danger">Retroceder</a>
    </form>
</div>
@endsection
