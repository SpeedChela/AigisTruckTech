<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'ap_pat',
        'ap_mat',
        'telefono',
        'direccion',
        'municipio_id',
        'id_tipo_usu',
        'status',
        'colonia',
        'cp',
        'fecha_naci',
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function esAdministrador()
    {
        return $this->id_tipo_usu === 1;
    }

    public function esSupervisor()
    {
        return $this->id_tipo_usu === 2;
    }

    public function esCliente()
    {
        return $this->id_tipo_usu === 3;
    }
} 