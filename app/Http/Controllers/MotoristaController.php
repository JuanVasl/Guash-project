<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function indexMotorista()
    {
        return view('Motorista.menuMotorista');
    }

    public function entregas()
    {
        return view('Motorista.entregasPendientes');
    }

    public function historial()
    {
        return view('Motorista.historialEntregas');
    }

}
