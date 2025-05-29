<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_ventas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ventas')->insert([
            [
                'id_usuario' => 4,
                'id_cliente' => 1,
                'fecha_venta' => '2024-05-05 14:00:00',
                'total' => 2400.00,
                'status' => 1
            ],
            [
                'id_usuario' => 5,
                'id_cliente' => 2,
                'fecha_venta' => '2024-05-06 15:30:00',
                'total' => 1800.00,
                'status' => 1
            ],
            [
                'id_usuario' => 6,
                'id_cliente' => 3,
                'fecha_venta' => '2024-05-07 16:45:00',
                'total' => 900.00,
                'status' => 1
            ],
        ]);
    }
}
