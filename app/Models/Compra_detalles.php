<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra_detalles extends Model
{
    protected $table = 'compras';
    protected $fillable = [
    'id_proveedor', 'id_usuario', 'fecha_compra', 'total', 'status'
    ];
}
