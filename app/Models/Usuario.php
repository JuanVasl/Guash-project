<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    public $table='usuario';
    public $timestamps=false;
    protected $fillable =[
        'id_usuario','nombre_usuario', 'usuario', 'contrasena', 'id_rol',
    ];

    protected $primaryKey = 'id_usuario';

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function rol()
    {
        return $this->belongsTo(rol::class, 'id_rol');
    }

    // Accesor para obtener el nombre del rol directamente
    public function getNombreRolAttribute()
    {
        return $this->rol->nombre_rol ?? null;
    }
}
