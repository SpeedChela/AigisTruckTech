<?php

namespace App\Http\Controllers;

use App\Models\Municipios;
use App\Models\Estados;
use App\Models\Paises;
use Illuminate\Http\Request;

class MunicipiosController extends Controller
{
    public function index()
    {
        $municipios = Municipios::all();
        return view('municipios.index', [
            'titulo' => 'Municipios',
            'singular' => 'Municipio',
            'ruta' => 'municipios',
            'columnas' => ['ID', 'Nombre', 'Clave', 'Estado', 'Status'],
            'campos' => ['id', 'nombre', 'clave', 'estado_id', 'status'],
            'registros' => $municipios
        ]);
    }

    public function create()
    {
        $paises = Paises::where('status', 1)
                      ->orderBy('nombre')
                      ->get();
        
        return view('municipios.create', compact('paises'));
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|max:80',
            'clave' => 'required|max:5',
            'estado_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        Municipios::create($request->all());
        return redirect()->route('municipios.index')->with('success', 'Municipio creado correctamente');
    }

    public function show($id) {
        $municipio = Municipios::findOrFail($id);
        return view('municipios.read', compact('municipio'));
    }

    public function edit($id) {
        $municipio = Municipios::findOrFail($id);
        $estados = Estados::all();
        return view('municipios.edit', compact('municipio', 'estados'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => 'required|max:80',
            'clave' => 'required|max:5',
            'estado_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        $municipio = Municipios::findOrFail($id);
        $municipio->update($request->all());
        return redirect()->route('municipios.index')->with('success', 'Municipio actualizado correctamente');
    }

    public function destroy($id) {
        $municipio = Municipios::findOrFail($id);
        $municipio->delete();
        return redirect()->route('municipios.index')->with('success', 'Municipio eliminado correctamente');
    }
}