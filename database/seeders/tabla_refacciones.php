<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_refacciones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('refacciones')->insert([
            // Refacciones de Kenworth
            ['id_proveedor'=>1, 'nombre'=>'Filtro de aceite Kenworth', 'marca'=>'Kenworth', 'categoria'=>'Motor', 'tipo_refaccion'=>'Original', 'precio'=>1200, 'stock'=>10, 'cant_existente'=>10, 'status'=>1],
            ['id_proveedor'=>1, 'nombre'=>'Espejo retrovisor Kenworth', 'marca'=>'Kenworth', 'categoria'=>'Carrocería', 'tipo_refaccion'=>'Alternativa', 'precio'=>700, 'stock'=>9, 'cant_existente'=>9, 'status'=>1],
            ['id_proveedor'=>1, 'nombre'=>'Llanta Kenworth', 'marca'=>'Kenworth', 'categoria'=>'Ruedas', 'tipo_refaccion'=>'Original', 'precio'=>4200, 'stock'=>10, 'cant_existente'=>10, 'status'=>1],
            ['id_proveedor'=>1, 'nombre'=>'Parabrisas Kenworth', 'marca'=>'Kenworth', 'categoria'=>'Carrocería', 'tipo_refaccion'=>'Alternativa', 'precio'=>1800, 'stock'=>5, 'cant_existente'=>5, 'status'=>1],
        
            // Refacciones de Cummins
            ['id_proveedor'=>2, 'nombre'=>'Filtro de aceite Cummins', 'marca'=>'Cummins', 'categoria'=>'Motor', 'tipo_refaccion'=>'Original', 'precio'=>1250, 'stock'=>8, 'cant_existente'=>8, 'status'=>1],
            ['id_proveedor'=>2, 'nombre'=>'Bujía Cummins', 'marca'=>'Cummins', 'categoria'=>'Motor', 'tipo_refaccion'=>'Original', 'precio'=>400, 'stock'=>30, 'cant_existente'=>30, 'status'=>1],
            ['id_proveedor'=>2, 'nombre'=>'Alternador Cummins', 'marca'=>'Cummins', 'categoria'=>'Eléctrico', 'tipo_refaccion'=>'Original', 'precio'=>2700, 'stock'=>3, 'cant_existente'=>3, 'status'=>1],
        
            // Refacciones de Volvo
            ['id_proveedor'=>3, 'nombre'=>'Amortiguador Volvo', 'marca'=>'Volvo', 'categoria'=>'Suspensión', 'tipo_refaccion'=>'Original', 'precio'=>1800, 'stock'=>7, 'cant_existente'=>7, 'status'=>1],
            ['id_proveedor'=>3, 'nombre'=>'Disco de freno Volvo', 'marca'=>'Volvo', 'categoria'=>'Frenos', 'tipo_refaccion'=>'Original', 'precio'=>950, 'stock'=>12, 'cant_existente'=>12, 'status'=>1],
            ['id_proveedor'=>3, 'nombre'=>'Manguera de radiador Volvo', 'marca'=>'Volvo', 'categoria'=>'Enfriamiento', 'tipo_refaccion'=>'Alternativa', 'precio'=>350, 'stock'=>18, 'cant_existente'=>18, 'status'=>1],
            ['id_proveedor'=>3, 'nombre'=>'Aceite de motor Volvo', 'marca'=>'Volvo', 'categoria'=>'Motor', 'tipo_refaccion'=>'Alternativa', 'precio'=>900, 'stock'=>25, 'cant_existente'=>25, 'status'=>1],
            ['id_proveedor'=>3, 'nombre'=>'Cilindro maestro Volvo', 'marca'=>'Volvo', 'categoria'=>'Frenos', 'tipo_refaccion'=>'Original', 'precio'=>1300, 'stock'=>7, 'cant_existente'=>7, 'status'=>1],
        
            // Refacciones de Freightliner
            ['id_proveedor'=>4, 'nombre'=>'Pastillas de freno Freightliner', 'marca'=>'Freightliner', 'categoria'=>'Frenos', 'tipo_refaccion'=>'Alternativa', 'precio'=>800, 'stock'=>20, 'cant_existente'=>20, 'status'=>1],
            ['id_proveedor'=>4, 'nombre'=>'Sensor ABS Freightliner', 'marca'=>'Freightliner', 'categoria'=>'Eléctrico', 'tipo_refaccion'=>'Original', 'precio'=>1100, 'stock'=>8, 'cant_existente'=>8, 'status'=>1],
            ['id_proveedor'=>4, 'nombre'=>'Batería Freightliner', 'marca'=>'Freightliner', 'categoria'=>'Eléctrico', 'tipo_refaccion'=>'Original', 'precio'=>3200, 'stock'=>6, 'cant_existente'=>6, 'status'=>1],
        
            // Refacciones de International
            ['id_proveedor'=>5, 'nombre'=>'Radiador International', 'marca'=>'International', 'categoria'=>'Enfriamiento', 'tipo_refaccion'=>'Original', 'precio'=>3200, 'stock'=>3, 'cant_existente'=>3, 'status'=>1],
            ['id_proveedor'=>5, 'nombre'=>'Compresor de aire International', 'marca'=>'International', 'categoria'=>'Aire', 'tipo_refaccion'=>'Original', 'precio'=>2100, 'stock'=>4, 'cant_existente'=>4, 'status'=>1],
            ['id_proveedor'=>5, 'nombre'=>'Filtro de combustible International', 'marca'=>'International', 'categoria'=>'Motor', 'tipo_refaccion'=>'Original', 'precio'=>650, 'stock'=>14, 'cant_existente'=>14, 'status'=>1],
        
            // Refacciones de otras marcas
            ['id_proveedor'=>6, 'nombre'=>'Filtro de aire Bosch', 'marca'=>'Bosch', 'categoria'=>'Aire', 'tipo_refaccion'=>'Alternativa', 'precio'=>600, 'stock'=>15, 'cant_existente'=>15, 'status'=>1],
            ['id_proveedor'=>7, 'nombre'=>'Turbocargador Motorcraft', 'marca'=>'Motorcraft', 'categoria'=>'Motor', 'tipo_refaccion'=>'Original', 'precio'=>8500, 'stock'=>2, 'cant_existente'=>2, 'status'=>1],
            ['id_proveedor'=>8, 'nombre'=>'Espejo retrovisor Denso', 'marca'=>'Denso', 'categoria'=>'Carrocería', 'tipo_refaccion'=>'Alternativa', 'precio'=>700, 'stock'=>9, 'cant_existente'=>9, 'status'=>1],
        ]);
    }
}
