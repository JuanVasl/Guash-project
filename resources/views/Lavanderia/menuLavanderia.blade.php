@extends('layauts.base')
@section('title', 'Lavandero')
@section('content')

<div class="container">
    <!-- Título -->
    <div class="container mt-2">
        <div class="col-12">
            <h3 class="text-start"><strong>¿Listos para lavar?</strong></h3>
        </div>
    </div>

    <!-- Botones de Pedir en espera y Solicitar Motorista-->
    <div class="row">
        <div class="col-6 d-flex justify-content-center">
            <div class="btn-container p-1" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                <form action="{{ route('pedidos') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                        <div class="d-flex justify-content-center" style="height: 75%;">
                            <img src="https://cdn-icons-png.flaticon.com/128/4003/4003663.png" alt="Pedidos en espera" style="max-width: 100%; max-height: 100%;">
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                            <p class="mt-2 text-center"><strong>Pedidos</strong></p>
                        </div>
                    </button>
                </form>
            </div>
        </div>

        <div class="col-6 d-flex justify-content-center">
            <div class="btn-container p-1" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                <form action="{{ route('historial.pedidos') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                        <div class="d-flex justify-content-center" style="height: 75%;">
                            <img src="https://cdn-icons-png.flaticon.com/128/6456/6456423.png" alt="Pedidos en espera" style="max-width: 100%; max-height: 100%;">
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                            <p class="mt-2 text-center"><strong>Historial</strong></p>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
