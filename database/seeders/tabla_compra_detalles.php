<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_compra_detalles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compra_detalles')->insert([
            // Compra 1
            [
                'id_compra' => 1,
                'id_producto' => 1,
                'cantidad' => 5,
                'precio_individual' => 1000.00,
                'subtotal' => 5000.00
            ],
            // Compra 2
            [
                'id_compra' => 2,
                'id_producto' => 2,
                'cantidad' => 4,
                'precio_individual' => 800.00,
                'subtotal' => 3200.00
            ],
            // Compra 3
            [
                'id_compra' => 3,
                'id_producto' => 3,
                'cantidad' => 2,
                'precio_individual' => 1050.00,
                'subtotal' => 2100.00
            ],
        ]);
    }
}
