<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
    'nombre', 'telefono', 'email', 'direccion', 'municipio_id',
    'codigo_postal', 'rfc', 'razon_social', 'direccion_fiscal', 'status'
    ];
}
