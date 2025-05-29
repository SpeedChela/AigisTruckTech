<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_estados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            // México (ID 1)
            ['pais_id' => 1, 'nombre' => 'CDMX', 'status' => 1],
            ['pais_id' => 1, 'nombre' => 'Edomex', 'status' => 1],
            ['pais_id' => 1, 'nombre' => 'Jalisco', 'status' => 1],
            ['pais_id' => 1, 'nombre' => 'Nuevo León', 'status' => 1],
            ['pais_id' => 1, 'nombre' => 'Puebla', 'status' => 1],
            ['pais_id' => 1, 'nombre' => 'Yucatán', 'status' => 1],
        
            // Estados Unidos (ID 2)
            ['pais_id' => 2, 'nombre' => 'California', 'status' => 1],
            ['pais_id' => 2, 'nombre' => 'Texas', 'status' => 1],
        
            // Canadá (ID 3)
            ['pais_id' => 3, 'nombre' => 'Ontario', 'status' => 1],
            ['pais_id' => 3, 'nombre' => 'Quebec', 'status' => 1],
        
            // Brasil (ID 4)
            ['pais_id' => 4, 'nombre' => 'São Paulo', 'status' => 1],
            ['pais_id' => 4, 'nombre' => 'Rio de Janeiro', 'status' => 1],
        
            // Argentina (ID 5)
            ['pais_id' => 5, 'nombre' => 'Buenos Aires', 'status' => 1],
            ['pais_id' => 5, 'nombre' => 'Córdoba', 'status' => 1],
        ]);
    }
}
