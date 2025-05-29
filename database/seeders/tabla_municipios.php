<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_municipios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipios')->insert([
            // México (4 municipios por estado)
            // CDMX
            ['estado_id' => 1, 'nombre' => 'Coyoacán', 'status' => 1],
            ['estado_id' => 1, 'nombre' => 'Iztapalapa', 'status' => 1],
            ['estado_id' => 1, 'nombre' => 'Tlalpan', 'status' => 1],
            ['estado_id' => 1, 'nombre' => 'Xochimilco', 'status' => 1],
            // Edomex
            ['estado_id' => 2, 'nombre' => 'Ecatepec', 'status' => 1],
            ['estado_id' => 2, 'nombre' => 'Naucalpan', 'status' => 1],
            ['estado_id' => 2, 'nombre' => 'Tlalnepantla', 'status' => 1],
            ['estado_id' => 2, 'nombre' => 'Toluca', 'status' => 1],
            // Jalisco
            ['estado_id' => 3, 'nombre' => 'Guadalajara', 'status' => 1],
            ['estado_id' => 3, 'nombre' => 'Zapopan', 'status' => 1],
            ['estado_id' => 3, 'nombre' => 'Tlaquepaque', 'status' => 1],
            ['estado_id' => 3, 'nombre' => 'Tonalá', 'status' => 1],
            // Nuevo León
            ['estado_id' => 4, 'nombre' => 'Monterrey', 'status' => 1],
            ['estado_id' => 4, 'nombre' => 'San Nicolás', 'status' => 1],
            ['estado_id' => 4, 'nombre' => 'Guadalupe', 'status' => 1],
            ['estado_id' => 4, 'nombre' => 'Apodaca', 'status' => 1],
            // Puebla
            ['estado_id' => 5, 'nombre' => 'Puebla', 'status' => 1],
            ['estado_id' => 5, 'nombre' => 'Tehuacán', 'status' => 1],
            ['estado_id' => 5, 'nombre' => 'Atlixco', 'status' => 1],
            ['estado_id' => 5, 'nombre' => 'San Martín Texmelucan', 'status' => 1],
            // Yucatán
            ['estado_id' => 6, 'nombre' => 'Mérida', 'status' => 1],
            ['estado_id' => 6, 'nombre' => 'Valladolid', 'status' => 1],
            ['estado_id' => 6, 'nombre' => 'Tizimín', 'status' => 1],
            ['estado_id' => 6, 'nombre' => 'Progreso', 'status' => 1],
        
            // Estados Unidos (1 municipio por estado)
            ['estado_id' => 7, 'nombre' => 'Los Angeles', 'status' => 1],    // California
            ['estado_id' => 8, 'nombre' => 'Houston', 'status' => 1],        // Texas
        
            // Canadá (1 municipio por estado)
            ['estado_id' => 9, 'nombre' => 'Toronto', 'status' => 1],        // Ontario
            ['estado_id' => 10, 'nombre' => 'Montreal', 'status' => 1],      // Quebec
        
            // Brasil (1 municipio por estado)
            ['estado_id' => 11, 'nombre' => 'São Paulo', 'status' => 1],     // São Paulo
            ['estado_id' => 12, 'nombre' => 'Rio de Janeiro', 'status' => 1],// Rio de Janeiro
        
            // Argentina (1 municipio por estado)
            ['estado_id' => 13, 'nombre' => 'Buenos Aires', 'status' => 1],  // Buenos Aires
            ['estado_id' => 14, 'nombre' => 'Córdoba', 'status' => 1],       // Córdoba
        ]);
    }
}
