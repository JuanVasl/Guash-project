<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    use HasFactory;

    public $table='pedido';
    public $timestamps=false;
    protected $fillable =[
        'id_pedido','fecha', 'id_cliente','id_estado','id_motista','id_lavandero'
    ];

    protected $primaryKey = 'id_pedido';
}
