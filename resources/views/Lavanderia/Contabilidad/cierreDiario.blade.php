@extends('layauts.base')
@section('title', 'Cierre Diario')
@section('content')
<div class="container">
    <style>
        input.form-control{
            height: 4vh;
            width: 25%;
        }
        label.form-label {
            font-weight: bold;
        }
        h3{
            font-weight: bold;
        }
    </style>

    <div class="col-12">
        <h3 class="text-center">Cierre &nbsp;{{ $fechaActual }}</h3>
    </div>

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                <form action="{{ route('cierre_diario.store') }}" method="POST">
                    @csrf

                    <!-- Campos mostrados al usuario -->
                    <div class="form-group d-flex justify-content-center">
                        <label class="form-label">Total Pedidos: &nbsp;</label>
                        <p>{{ $totalPedidos }}</p>
                        <input type="hidden" name="total_pedidos" value="{{ $totalPedidos }}">

                        <span style="margin: 0 5px;"></span>
                        <label class="form-label">Total Ingresos: &nbsp;</label>
                        <p>Q{{ $totalIngresos }}</p>
                        <input type="hidden" name="total_ingresos" value="{{ $totalIngresos }}">
                    </div>

                    <div class="form-group d-flex justify-content-start">
                        <label class="form-label">Detergente Usado: &nbsp;</label>
                        <p>{{ $totalDetergente }} Copas</p>
                        <input type="hidden" name="detergente_usado" value="{{ $totalDetergente }}">
                    </div>

                    <div class="form-group d-flex justify-content-start">
                        <label class="form-label">Suavizante Usado: &nbsp;</label>
                        <p>{{ $totalSuavizante }} Copas</p>
                        <input type="hidden" name="suavizante_usado" value="{{ $totalSuavizante }}">
                    </div>

                    <!-- Inputs visibles para los datos adicionales -->
                    <div class="form-group d-flex justify-content-between">
                        <label class="form-label">Energía Consumida (kWh):&nbsp;</label>
                        <input type="number" class="form-control" id="energia_consumida" name="energia_consumida" required>
                    </div>

                    <div class="form-group d-flex justify-content-between">
                        <label class="form-label">Agua Consumida (Litros): &nbsp;</label>
                        <input type="number" class="form-control" id="agua_consumida" name="agua_consumida" required>
                    </div>

                    <div class="form-group d-flex justify-content-between">
                        <label class="form-label">Gas Consumido (Libras): &nbsp;</label>
                        <input type="number" class="form-control" id="gas_consumido" name="gas_consumido" required>
                    </div>

                    <div class="links mt-2">
                        <button type="submit" class="btn btn-primary">Aplicar</button>
                        <a href="/menuAdmin/Conta" class="btn btn-danger">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
