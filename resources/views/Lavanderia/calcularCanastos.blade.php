@extends('layauts.base')

@section('title', 'Calcular Canastos')

@section('content')
<div class="container">

    <!-- Detalles del pedido -->
    <div class="col-12 d-flex justify-content-center">
        <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%; text-align:center;">
            <h6><strong>{{ $pedido->id_pedido }} - {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/y') }}</strong></h6>
            
            <!-- Cantidad de canastos -->
            <p>Cantidad de canastos</p>
            <div class="quantity-container d-flex justify-content-center align-items-center">
                <button class="btn btn-light btn-decrease" style="font-size: 20px;">-</button>
                <span class="mx-3" style="font-size: 20px;">1</span>
                <button class="btn btn-light btn-increase" style="font-size: 20px;">+</button>
            </div>

            <!-- Precio -->
            <p class="mt-3" style="font-size: 24px;"><strong id="precioTotal">Q25.00</strong></p> 
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="col-12 d-flex justify-content-center mt-4">
        <div class="links d-flex flex-column align-items-center">
            <button class="btn btn-success mb-2" style="width: 200px;">Asignar insumos</button>
            <a href="/pedidos" class="btn btn-danger" style="width: 200px;">Retroceder</a>
        </div>
    </div>

</div>

<!-- Estilos CSS embebidos -->
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 350px;
        margin: auto;
    }

    h4, h5, h6 {
        margin: 0;
    }

    .btn-container {
        background-color: #d9d9d9;
        padding: 15px;
        border-radius: 15px;
        text-align: center;
    }

    .quantity-container {
        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        margin-top: 10px;
    }

    .quantity-container button {
        background-color: #f0f0f0;
        border: none;
        padding: 10px;
        font-size: 20px;
    }

    .links button {
        font-size: 16px;
    }

    .footer-icons {
        font-size: 24px;
    }

    .btn-dark i {
        margin-right: 5px;
    }
</style>


<!-- JavaScript para manejar la cantidad -->
<script>
    let quantity = 1;
    const quantityDisplay = document.querySelector('.quantity-container span');
    const precioTotalDisplay = document.getElementById('precioTotal');
    const precioPorCanasto = 25; // Precio por canasto

    // Función para actualizar el precio total
    function updatePrice() {
        const total = quantity * precioPorCanasto;
        precioTotalDisplay.textContent = 'Q' + total.toFixed(2); // Actualiza el precio con dos decimales
    }

    document.querySelector('.btn-increase').addEventListener('click', () => {
        quantity++;
        quantityDisplay.textContent = quantity;
        updatePrice(); // Llama a la función para actualizar el precio
    });

    document.querySelector('.btn-decrease').addEventListener('click', () => {
        if (quantity > 1) {
            quantity--;
            quantityDisplay.textContent = quantity;
            updatePrice(); // Llama a la función para actualizar el precio
        }
    });
</script>
@endsection
