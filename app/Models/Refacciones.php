<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refacciones extends Model
{
    use HasFactory;
    
    protected $table = 'refacciones';
    
    protected $fillable = [
        'id_proveedor',
        'nombre',
        'marca',
        'categoria',
        'tipo_refaccion',
        'precio',
        'stock',
        'cant_existente',
        'foto',
        'status'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'status' => 'integer'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'id_proveedor');
    }
}
