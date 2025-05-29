<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $table = 'usuarios';
    protected $fillable = [
    'nombre', 'email', 'password', 'telefono', 'rol', 'status'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
