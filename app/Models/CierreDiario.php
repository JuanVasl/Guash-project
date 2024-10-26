<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CierreDiario extends Model
{
    use HasFactory;

    protected $table = 'cierre_diario';
    protected $primaryKey = 'id_cierre';
    public $timestamps = false; // Cambiar a true si deseas manejar timestamps

    protected $fillable = [
        'fecha', 'total_pedidos', 'total_ingresos', 'detergente_usado',
        'suavizante_usado', 'otros_insumos_usados',
        'energia_consumida', 'agua_consumida', 'gas_consumido',
    ];
}
