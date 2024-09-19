<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    use HasFactory;

    public $table='cliente';
    public $timestamps=false;
    protected $fillable =[
        'id_cliente','nombre_cliente', 'apellido_cliente', 'correo_cliente', 'contra_cliente', 'tele_cliente', 'direccion',
        'referencia', 'id_ubicacion','id_tipo_direcc'
    ];

    protected $primaryKey = 'id_cliente';

    public function getAuthPassword()
    {
        return $this->contra_cliente;
    }
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_cliente');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }

    public function tipoDireccion()
    {
        return $this->belongsTo(TipoDireccion::class, 'id_tipo_direcc', 'id_tipo_direcc');
    }

}
