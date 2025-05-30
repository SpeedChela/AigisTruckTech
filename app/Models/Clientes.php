<?php

namespace App\Models;
use App\Models\Municipios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    
    protected $table = 'clientes';
    protected $fillable = [
        'nombre', 
        'telefono', 
        'email', 
        'direccion', 
        'municipio_id',
        'codigo_postal', 
        'rfc', 
        'razon_social', 
        'direccion_fiscal', 
        'status'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'municipio_id');
    }
}
