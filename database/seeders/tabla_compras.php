<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_compras extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compras')->insert([
            [
                'id_proveedor' => 1,
                'id_usuario' => 1,
                'fecha_compra' => '2024-05-01 10:00:00',
                'total' => 5000.00,
                'status' => 1
            ],
            [
                'id_proveedor' => 2,
                'id_usuario' => 2,
                'fecha_compra' => '2024-05-02 11:30:00',
                'total' => 3200.00,
                'status' => 1
            ],
            [
                'id_proveedor' => 3,
                'id_usuario' => 3,
                'fecha_compra' => '2024-05-03 09:15:00',
                'total' => 2100.00,
                'status' => 1
            ],
        ]);
    }
}
