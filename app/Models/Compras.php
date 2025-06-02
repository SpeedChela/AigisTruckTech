<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $table = 'compras';
    protected $fillable = [
    'id_proveedor', 'id_usuario', 'fecha_compra', 'total', 'status'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'id_proveedor');
    }

    public function detalles()
    {
        return $this->hasMany(CompraDetalles::class, 'id_compra');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
