<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $table = 'estados';
    protected $fillable = ['pais_id', 'nombre', 'status'];
}
