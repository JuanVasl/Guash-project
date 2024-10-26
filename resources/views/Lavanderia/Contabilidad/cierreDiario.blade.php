@extends('layauts.base')

@section('content')
<div class="container">
    <h1>Cierre Diario</h1>

    <form action="{{ route('cierre_diario.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="total_pedidos" class="form-label">Total Pedidos</label>
            <input type="text" class="form-control" id="total_pedidos" name="total_pedidos" value="{{ $totalPedidos }}" readonly>
        </div>

        <div class="mb-3">
            <label for="total_ingresos" class="form-label">Total Ingresos</label>
            <input type="text" class="form-control" id="total_ingresos" name="total_ingresos" value="{{ $totalIngresos }}" readonly>
        </div>

        <div class="mb-3">
            <label for="detergente_usado" class="form-label">Detergente Usado (ml)</label>
            <input type="number" class="form-control" id="detergente_usado" name="detergente_usado" required>
        </div>

        <div class="mb-3">
            <label for="suavizante_usado" class="form-label">Suavizante Usado (ml)</label>
            <input type="number" class="form-control" id="suavizante_usado" name="suavizante_usado" required>
        </div>

        <div class="mb-3">
            <label for="energia_consumida" class="form-label">Energía Consumida (kWh)</label>
            <input type="number" class="form-control" id="energia_consumida" name="energia_consumida" required>
        </div>

        <div class="mb-3">
            <label for="agua_consumida" class="form-label">Agua Consumida (litros)</label>
            <input type="number" class="form-control" id="agua_consumida" name="agua_consumida" required>
        </div>

        <div class="mb-3">
            <label for="gas_consumido" class="form-label">Gas Consumido (Lbs)</label>
            <input type="number" class="form-control" id="gas_consumido" name="gas_consumido" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cierre Diario</button>
        <a href="/menuAdmin/Conta" class="btn btn-danger">Regresar</a>
    </form>
</div>
@endsection
