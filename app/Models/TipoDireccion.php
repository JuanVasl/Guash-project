<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDireccion extends Model
{
    protected $table = 'tipo_direcc';
    protected $primaryKey = 'id_tipo_direcc';
    public $timestamps = false;

    protected $fillable = [
        'tipo'
    ];
}
