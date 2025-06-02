<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta_detalles extends Model
{
    use HasFactory;
    
    protected $table = 'venta_detalles';
    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio_individual',
        'subtotal'
    ];

    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'id_venta');
    }

    public function refaccion()
    {
        return $this->belongsTo(Refacciones::class, 'id_producto');
    }
}
