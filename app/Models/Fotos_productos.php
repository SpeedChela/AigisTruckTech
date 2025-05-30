<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotos_productos extends Model
{
    use HasFactory;

    protected $table = 'fotos_productos';

    protected $fillable = [
        'producto_id',
        'ruta',
        'status'
    ];

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
}
