<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    public $table='estado';
    public $timestamps=false;
    protected $fillable =[
        'id_estado', 'estado',
    ];

    protected $primaryKey = 'id_estado';
}
