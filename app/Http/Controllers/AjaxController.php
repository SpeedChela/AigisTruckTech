<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Estados;
use App\Models\Municipios;

class AjaxController extends Controller
{
    public function cambia_combo_estado($id_pais) {
        $estados = Estados::select('id','nombre')
        ->where('pais_id', $id_pais)
        ->orderBy('nombre')
        ->get();
    }

    public function cambia_combo_municipio($id_estado) {
    $municipios = Municipios::select('id','nombre')
        ->where('estado_id', $id_estado)
        ->orderBy('nombre')
        ->get();
    return response()->json($municipios);
    }
}