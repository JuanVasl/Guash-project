<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LavanderiaController extends Controller
{
    public function indexLavanderia()
    {
        return view('Lavanderia.menuLavanderia');
    }

    public function indexAdministrador()
    {
        return view('Lavanderia.menuAdministrador');
    }
}
