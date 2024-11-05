<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    use HasFactory;

    public $table='rol';
    public $timestamps=false;
    protected $fillable =[
        'id_rol', 'nombre_rol'
    ];

    protected $primaryKey = 'id_rol';
}
