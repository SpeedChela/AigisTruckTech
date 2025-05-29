<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_estado_envios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_envios')->insert([
            [
                'id_compra' => 1, // Aquí va el id de la compra o venta según tu estructura
                'status' => 1     // 1 = Enviado, 0 = Pendiente, etc.
            ],
        ]);
    }
}
