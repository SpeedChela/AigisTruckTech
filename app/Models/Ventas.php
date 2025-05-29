<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $fillable = [
    'id_usuario', 'id_cliente', 'fecha_venta', 'total', 'status'
    ];
}
