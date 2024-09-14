<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioServicio extends Model
{
    protected $table = 'precio_servicio';
    protected $primaryKey = 'id_precio_serv';
    public $timestamps = false;

    protected $fillable = [
        'servicio',
        'precio',
        'vigencia',
        'fecha_inicio',
        'fecha_fin'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

}
