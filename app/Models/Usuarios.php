<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuarios extends Authenticatable
{
    use HasFactory, Notifiable;

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

    public function esSuperusuario()
    {
        return $this->rol === 1;
    }

    public function esAdministrador()
    {
        // El administrador tiene acceso a todo excepto usuarios
        return $this->rol === 2;
    }

    public function esEmpleado()
    {
        // El empleado tiene sus propios permisos o hereda del admin
        return $this->rol === 3 || $this->esAdministrador();
    }

    public function esCliente()
    {
        return $this->rol === 4;
    }

    // Método helper para verificar cualquier rol
    public function tieneRol($rol)
    {
        if ($this->esSuperusuario()) {
            return true;
        }
        if ($this->esAdministrador() && $rol !== 1) {  // Admin tiene todo excepto rol 1 (superusuario)
            return true;
        }
        return $this->rol === $rol;
    }
}
