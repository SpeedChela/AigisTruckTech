<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $fillable = [
        'id_usuario', 
        'id_cliente', 
        'fecha_venta', 
        'subtotal',
        'iva',
        'total', 
        'status'
    ];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }

    public function detalles()
    {
        return $this->hasMany(Venta_detalles::class, 'id_venta');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
