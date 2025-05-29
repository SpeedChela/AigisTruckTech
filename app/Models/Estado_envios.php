<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_envios extends Model
{
    protected $table = 'estado_envios';
    protected $fillable = ['id_compra', 'status'];
}
