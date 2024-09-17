@extends('layauts.base')
@section('title', 'Motorista')
@section('content')
<div class="container">
    <!-- Título -->
    <div class="container mt-2">
        <div class="col-12">
            <h3 class="text-start"><strong>¿Preparado para trabajar?</strong></h3>
        </div>
    </div>

    <!-- Botones de Pedir ahora y Programar pedido -->
    <div class="row mb-3 mt-3">
        <div class="col-6 d-flex justify-content-center">
            <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                <a href="/entregas" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                    <div class="d-flex justify-content-center" style="height: 75%;">
                        <img src="https://cdn-icons-png.freepik.com/256/6179/6179620.png" alt="Programar pedido" style="max-width: 100%; max-height: 100%;">
                    </div>
                    <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                        <p class="mt-5 text-center"><strong>Entregas pendientes</strong></p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-center">
            <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                <a href="/historial" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                    <div class="d-flex justify-content-center" style="height: 75%;">
                        <img src="https://cdn-icons-png.freepik.com/256/5457/5457874.png" alt="Programar pedido" style="max-width: 100%; max-height: 100%;">
                    </div>
                    <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                        <p class="mt-5 text-center"><strong>Historial de entregas</strong></p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

