<?php

namespace App\Http\Controllers;

use App\Models\Estados;
use App\Models\Paises;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
    public function index()
    {
        $estados = Estados::all();
        return view('estados.index', [
            'titulo' => 'Estados',
            'singular' => 'Estado',
            'ruta' => 'estados',
            'columnas' => ['ID', 'Nombre', 'Clave', 'País', 'Status'],
            'campos' => ['id', 'nombre', 'clave', 'pais_id', 'status'],
            'registros' => $estados
        ]);
    }

    public function create() {
        $paises = Paises::all();
        return view('estados.create', compact('paises'));
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|max:80',
            'clave' => 'required|max:5',
            'pais_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        Estados::create($request->all());
        return redirect()->route('estados.index')->with('success', 'Estado creado correctamente');
    }

    public function show($id) {
        $estado = Estados::findOrFail($id);
        return view('estados.read', compact('estado'));
    }

    public function edit($id) {
        $estado = Estados::findOrFail($id);
        $paises = Paises::all();
        return view('estados.edit', compact('estado', 'paises'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => 'required|max:80',
            'clave' => 'required|max:5',
            'pais_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        $estado = Estados::findOrFail($id);
        $estado->update($request->all());
        return redirect()->route('estados.index')->with('success', 'Estado actualizado correctamente');
    }

    public function destroy($id) {
        $estado = Estados::findOrFail($id);
        $estado->delete();
        return redirect()->route('estados.index')->with('success', 'Estado eliminado correctamente');
    }
}