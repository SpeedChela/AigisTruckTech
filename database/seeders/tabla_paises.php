<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_paises extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paises')->insert([
            [
                'nombre' => 'México',
                'clave'  => 'MX',
                'status' => 1
            ],
            [
                'nombre' => 'Estados Unidos',
                'clave'  => 'US',
                'status' => 1
            ],
            [
                'nombre' => 'Canadá',
                'clave'  => 'CA',
                'status' => 1
            ],
            [
                'nombre' => 'Brasil',
                'clave'  => 'BR',
                'status' => 1
            ],
            [
                'nombre' => 'Argentina',
                'clave'  => 'AR',
                'status' => 1
            ],
        ]);
    }
}
