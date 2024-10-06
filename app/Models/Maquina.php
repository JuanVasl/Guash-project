<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    use HasFactory;

    protected $table = 'maquina';

    // Deshabilitar timestamps
    public $timestamps = false;

    protected $fillable = [
        'id_tipo',
        'modelo',
        'marca',
        'serie',
        'capacidad',
        'estado_id_estado',
    ];
}
