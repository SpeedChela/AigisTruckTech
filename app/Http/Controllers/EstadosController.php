<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
    public function index()
    {
        $estados = Estado::all();
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
        return view('estados.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|max:80',
            'clave' => 'required|max:5',
            'pais_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        Estado::create($request->all());
        return redirect()->route('estados.index')->with('success', 'Estado creado correctamente');
    }

    public function show($id) {
        $estado = Estado::findOrFail($id);
        return view('estados.read', compact('estado'));
    }

    public function edit($id) {
        $estado = Estado::findOrFail($id);
        return view('estados.edit', compact('estado'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => 'required|max:80',
            'clave' => 'required|max:5',
            'pais_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        $estado = Estado::findOrFail($id);
        $estado->update($request->all());
        return redirect()->route('estados.index')->with('success', 'Estado actualizado correctamente');
    }

    public function destroy($id) {
        $estado = Estado::findOrFail($id);
        $estado->delete();
        return redirect()->route('estados.index')->with('success', 'Estado eliminado correctamente');
    }
}