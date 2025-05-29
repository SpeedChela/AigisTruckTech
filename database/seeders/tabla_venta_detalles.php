<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_venta_detalles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('venta_detalles')->insert([
            // Venta 1
            [
                'id_venta' => 1,
                'id_producto' => 1,
                'cantidad' => 2,
                'precio_individual' => 1200.00,
                'subtotal' => 2400.00
            ],
            // Venta 2
            [
                'id_venta' => 2,
                'id_producto' => 2,
                'cantidad' => 3,
                'precio_individual' => 600.00,
                'subtotal' => 1800.00
            ],
            // Venta 3
            [
                'id_venta' => 3,
                'id_producto' => 3,
                'cantidad' => 1,
                'precio_individual' => 900.00,
                'subtotal' => 900.00
            ],
        ]);
    }
}
