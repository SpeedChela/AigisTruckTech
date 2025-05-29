<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_empresas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            [
                'id_usuario_up' => 1, // ID del usuario que creó o administra la empresa
                'direccion' => 'Av. de los Transportistas 123, Parque Industrial, CDMX',
                'mision' => 'Ofrecer las mejores refacciones y servicios para tractocamiones, garantizando calidad, confianza y rapidez a nuestros clientes.',
                'vision' => 'Ser la empresa líder en el suministro de refacciones para tractocamiones en México, reconocida por su innovación y excelencia en el servicio.',
                'valores' => 'Compromiso, Honestidad, Innovación, Trabajo en equipo, Responsabilidad',
                'telefono' => '555-123-4567',
                'correo' => 'contacto@tractorefacciones.com',
                'latitud' => 19.432608,
                'longitud' => -99.133209,
                'status' => 1
            ]
        ]);
    }
}
