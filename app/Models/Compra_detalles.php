<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra_detalles extends Model
{
    protected $table = 'compra_detalles';
    protected $fillable = [
        'id_compra', 'id_producto', 'cantidad', 'precio_individual', 'subtotal'
    ];
}
