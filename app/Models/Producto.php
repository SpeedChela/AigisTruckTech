<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'destacado',
        'categoria',
        'status'
    ];

    protected $casts = [
        'destacado' => 'boolean',
        'status' => 'boolean',
        'precio' => 'decimal:2'
    ];

    public function fotos()
    {
        return $this->hasMany(FotoProducto::class, 'producto_id');
    }

    public function fotoPrincipal()
    {
        return $this->hasOne(FotoProducto::class, 'producto_id')->where('es_principal', true);
    }
} 