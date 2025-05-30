<?php

namespace App\Models;
use App\Models\estado;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $table = 'municipios';
    protected $fillable = ['nombre', 'clave', 'estado_id', 'status'];

    public function estado()
    {
        return $this->belongsTo(Estados::class, 'estado_id');
    }
}
