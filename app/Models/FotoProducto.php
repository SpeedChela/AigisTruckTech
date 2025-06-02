<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProducto extends Model
{
    use HasFactory;

    protected $table = 'fotos_productos';

    protected $fillable = [
        'producto_id',
        'ruta',
        'es_principal',
        'status'
    ];

    protected $casts = [
        'es_principal' => 'boolean',
        'status' => 'boolean'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
} 