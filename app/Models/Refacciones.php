<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refacciones extends Model
{
    protected $table = 'refacciones';
    protected $fillable = [
    'id_proveedor', 'nombre', 'marca', 'categoria', 'tipo_refaccion',
    'precio', 'stock', 'cant_existente', 'status'
    ];
}
