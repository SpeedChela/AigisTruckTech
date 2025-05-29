<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class tabla_usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Roles:
     * 1 = Superusuario
     * 2 = Administrador
     * 3 = Empleado
     * 4 = Cliente
     * Status:
     * 1 = Activo
     * 0 = Inactivo
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            // Superusuario
            [
                'nombre' => 'María González',
                'email' => 'maria.gonzalez@admin.com',
                'password' => bcrypt('super123'),
                'telefono' => '555-1001',
                'rol' => 1,
                'status' => 1
            ],
            // Administradores
            [
                'nombre' => 'Carlos Ramírez',
                'email' => 'carlos.ramirez@admin.com',
                'password' => bcrypt('admin123'),
                'telefono' => '555-1002',
                'rol' => 2,
                'status' => 1
            ],
            [
                'nombre' => 'Ana Torres',
                'email' => 'ana.torres@admin.com',
                'password' => bcrypt('admin123'),
                'telefono' => '555-1003',
                'rol' => 2,
                'status' => 1
            ],
            // Empleados
            [
                'nombre' => 'Luis Hernández',
                'email' => 'luis.hernandez@empresa.com',
                'password' => bcrypt('empleado123'),
                'telefono' => '555-1004',
                'rol' => 3,
                'status' => 1
            ],
            [
                'nombre' => 'Sofía Martínez',
                'email' => 'sofia.martinez@empresa.com',
                'password' => bcrypt('empleado123'),
                'telefono' => '555-1005',
                'rol' => 3,
                'status' => 1
            ],
            [
                'nombre' => 'Jorge López',
                'email' => 'jorge.lopez@empresa.com',
                'password' => bcrypt('empleado123'),
                'telefono' => '555-1006',
                'rol' => 3,
                'status' => 1
            ],
            [
                'nombre' => 'Gabriela Díaz',
                'email' => 'gabriela.diaz@empresa.com',
                'password' => bcrypt('empleado123'),
                'telefono' => '555-1007',
                'rol' => 3,
                'status' => 1
            ],
            // Clientes
            [
                'nombre' => 'Ricardo Pérez',
                'email' => 'ricardo.perez@cliente.com',
                'password' => bcrypt('cliente123'),
                'telefono' => '555-1008',
                'rol' => 4,
                'status' => 1
            ],
            [
                'nombre' => 'Fernanda Castro',
                'email' => 'fernanda.castro@cliente.com',
                'password' => bcrypt('cliente123'),
                'telefono' => '555-1009',
                'rol' => 4,
                'status' => 1
            ],
            [
                'nombre' => 'Miguel Ángel Ruiz',
                'email' => 'miguel.ruiz@cliente.com',
                'password' => bcrypt('cliente123'),
                'telefono' => '555-1010',
                'rol' => 4,
                'status' => 1
            ],
        ]);
    }
}