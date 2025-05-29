<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta_detalles extends Model
{
    protected $table = 'venta_detalles';
    protected $fillable = [
    'id_venta', 'id_producto', 'cantidad', 'precio_individual', 'subtotal'
    ];
}
