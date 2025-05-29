<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipiosController extends Controller
{
    public function index()
    {
        $municipios = Municipio::all();
        return view('municipios.index', [
            'titulo' => 'Municipios',
            'singular' => 'Municipio',
            'ruta' => 'municipios',
            'columnas' => ['ID', 'Nombre', 'Clave', 'Estado', 'Status'],
            'campos' => ['id', 'nombre', 'clave', 'estado_id', 'status'],
            'registros' => $municipios
        ]);
    }

    public function create() {
        return view('municipios.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|max:80',
            'clave' => 'required|max:5',
            'estado_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        Municipio::create($request->all());
        return redirect()->route('municipios.index')->with('success', 'Municipio creado correctamente');
    }

    public function show($id) {
        $municipio = Municipio::findOrFail($id);
        return view('municipios.read', compact('municipio'));
    }

    public function edit($id) {
        $municipio = Municipio::findOrFail($id);
        return view('municipios.edit', compact('municipio'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => 'required|max:80',
            'clave' => 'required|max:5',
            'estado_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        $municipio = Municipio::findOrFail($id);
        $municipio->update($request->all());
        return redirect()->route('municipios.index')->with('success', 'Municipio actualizado correctamente');
    }

    public function destroy($id) {
        $municipio = Municipio::findOrFail($id);
        $municipio->delete();
        return redirect()->route('municipios.index')->with('success', 'Municipio eliminado correctamente');
    }
}