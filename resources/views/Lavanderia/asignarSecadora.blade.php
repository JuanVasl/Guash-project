@extends('layauts.base')
@section('title', 'Asignar Secadora')
@section('content')

<div class="container">
    <h3>Asignar Secadora para el Pedido {{ $pedido->id_pedido }}</h3>
    <form action="{{ route('guardar.asignacionSecadora', $pedido->id_pedido) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_secadora">Seleccionar Secadora:</label>
            <select name="id_maquina" id="id_secadora" required> <!-- Cambié el nombre a 'id_maquina' -->
                <option value="">Seleccionar secadora...</option> <!-- Opción por defecto -->
                @foreach ($secadora as $secadoras)
                    <option value="{{ $secadoras->id_maquina }}">SEC{{ $secadoras->id_maquina }} - {{ $secadoras->marca }} - {{ $secadoras->capacidad }}LBS</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Asignar secadora</button>
    </form>
</div>
@endsection
