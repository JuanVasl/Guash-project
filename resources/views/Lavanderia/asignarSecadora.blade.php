@extends('layauts.base')

@section('title', 'Asignar Secadora')

@section('content')
<div class="container">
    <h4>Asignar Secadora a Pedido: {{ $pedido->id_pedido }}</h4>
    
    <form action="{{ route('guardarAsignacionSecadora', $pedido->id_pedido) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="secadora">Seleccione una Secadora:</label>
            <select name="id_secadora" id="secadora" class="form-control">
                @foreach($secadorasDisponibles as $secadora)
                    <option value="{{ $secadora->id_maquina }}">{{ $secadora->modelo }} (Capacidad: {{ $secadora->capacidad }})</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Asignar Secadora</button>
        <a href="{{ route('pedidos') }}" class="btn btn-danger">Retroceder</a>
    </form>
</div>
@endsection
