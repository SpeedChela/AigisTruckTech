<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $table = 'empresas';
    protected $fillable = [
    'id_usuario_up', 'direccion', 'mision', 'vision', 'valores',
    'telefono', 'correo', 'latitud', 'longitud', 'status'
];
}
