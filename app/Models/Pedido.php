<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';
    protected $primaryKey = 'id_pedido';
    public $timestamps = false;
    protected $fillable = [
        'fecha', 'id_cliente', 'programado', 'cant_canasto', 'id_precio_serv',
        'total_servicio', 'id_estado', 'detergente', 'suavizante',
        'id_motorista', 'id_lavandero'
    ];

    // Relaciones con otras tablas
    // En el modelo Pedido
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function precioServicio()
    {
        return $this->belongsTo(PrecioServicio::class, 'id_precio_serv', 'id_precio_serv');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }

    public function motorista()
    {
        return $this->belongsTo(Usuario::class, 'id_motorista');
    }

    public function lavandero()
    {
        return $this->belongsTo(Usuario::class, 'id_lavandero');
    }
}
