<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'proveedores';
    protected $fillable = [
    'nombre', 'telefono', 'email', 'direccion', 'municipio_id', 'status'
    ];

    public function refacciones()
    {
        return $this->hasMany(Refacciones::class, 'id_proveedor');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'municipio_id');
    }
}
