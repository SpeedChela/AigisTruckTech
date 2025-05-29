<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_proveedores extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedores')->insert([
            // Proveedores de refacciones por marca
            ['nombre'=>'Refacciones Kenworth', 'telefono'=>'555-1001', 'email'=>'kenworth@proveedor.com', 'direccion'=>'Kenworth 1', 'municipio_id'=>1, 'status'=>1],
            ['nombre'=>'Refacciones Cummins', 'telefono'=>'555-1002', 'email'=>'cummins@proveedor.com', 'direccion'=>'Cummins 2', 'municipio_id'=>2, 'status'=>1],
            ['nombre'=>'Refacciones Volvo', 'telefono'=>'555-1003', 'email'=>'volvo@proveedor.com', 'direccion'=>'Volvo 3', 'municipio_id'=>3, 'status'=>1],
            ['nombre'=>'Refacciones Freightliner', 'telefono'=>'555-1004', 'email'=>'freightliner@proveedor.com', 'direccion'=>'Freightliner 4', 'municipio_id'=>4, 'status'=>1],
            ['nombre'=>'Refacciones International', 'telefono'=>'555-1005', 'email'=>'international@proveedor.com', 'direccion'=>'International 5', 'municipio_id'=>5, 'status'=>1],
            ['nombre'=>'Refacciones Bosch', 'telefono'=>'555-1006', 'email'=>'bosch@proveedor.com', 'direccion'=>'Bosch 6', 'municipio_id'=>6, 'status'=>1],
            ['nombre'=>'Refacciones Motorcraft', 'telefono'=>'555-1007', 'email'=>'motorcraft@proveedor.com', 'direccion'=>'Motorcraft 7', 'municipio_id'=>7, 'status'=>1],
            ['nombre'=>'Refacciones Denso', 'telefono'=>'555-1008', 'email'=>'denso@proveedor.com', 'direccion'=>'Denso 8', 'municipio_id'=>8, 'status'=>1],
        ]);
    }
}
