<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_clientes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            // Clientes de empresas de transporte
            ['nombre'=>'Transportes del Norte', 'telefono'=>'555-1111', 'email'=>'norte@trans.com', 'direccion'=>'Av. Norte 100', 'municipio_id'=>1, 'codigo_postal'=>'01000', 'rfc'=>'TNO123456AAA', 'razon_social'=>'Transportes del Norte S.A.', 'direccion_fiscal'=>'Fiscal Norte 100', 'status'=>1],
            ['nombre'=>'Logística Express', 'telefono'=>'555-2222', 'email'=>'express@log.com', 'direccion'=>'Calle Express 200', 'municipio_id'=>2, 'codigo_postal'=>'02000', 'rfc'=>'LEX654321BBB', 'razon_social'=>'Logística Express S.A.', 'direccion_fiscal'=>'Fiscal Express 200', 'status'=>1],
            ['nombre'=>'Camiones del Bajío', 'telefono'=>'555-3333', 'email'=>'bajio@cam.com', 'direccion'=>'Bajío 300', 'municipio_id'=>3, 'codigo_postal'=>'03000', 'rfc'=>'CBA789456CCC', 'razon_social'=>'Camiones del Bajío S.A.', 'direccion_fiscal'=>'Fiscal Bajío 300', 'status'=>1],
            ['nombre'=>'Fletes y Mudanzas', 'telefono'=>'555-4444', 'email'=>'fletes@mud.com', 'direccion'=>'Mudanzas 400', 'municipio_id'=>4, 'codigo_postal'=>'04000', 'rfc'=>'FYM321654DDD', 'razon_social'=>'Fletes y Mudanzas S.A.', 'direccion_fiscal'=>'Fiscal Mudanzas 400', 'status'=>1],
            ['nombre'=>'Carga Segura', 'telefono'=>'555-5555', 'email'=>'carga@segura.com', 'direccion'=>'Segura 500', 'municipio_id'=>5, 'codigo_postal'=>'05000', 'rfc'=>'CSE987654EEE', 'razon_social'=>'Carga Segura S.A.', 'direccion_fiscal'=>'Fiscal Segura 500', 'status'=>1],
            ['nombre'=>'Tracto Rápido', 'telefono'=>'555-6666', 'email'=>'rapido@tracto.com', 'direccion'=>'Rápido 600', 'municipio_id'=>6, 'codigo_postal'=>'06000', 'rfc'=>'TRA456789FFF', 'razon_social'=>'Tracto Rápido S.A.', 'direccion_fiscal'=>'Fiscal Rápido 600', 'status'=>1],
        ]);
    }
}
