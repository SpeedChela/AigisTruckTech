<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisesController extends Controller
{
    public function index()
    {
        $paises = Pais::all();
        return view('paises.index', [
            'titulo' => 'Países',
            'singular' => 'País',
            'ruta' => 'paises',
            'columnas' => ['ID', 'Nombre', 'Clave', 'Status'],
            'campos' => ['id', 'nombre', 'clave', 'status'],
            'registros' => $paises
        ]);
    }

    public function create() {
        return view('paises.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|max:80',
            'clave' => 'required|max:5',
            'status' => 'required|integer'
        ]);
        Pais::create($request->all());
        return redirect()->route('paises.index')->with('success', 'País creado correctamente');
    }

    public function show($id) {
        $pais = Pais::findOrFail($id);
        return view('paises.read', compact('pais'));
    }

    public function edit($id) {
        $pais = Pais::findOrFail($id);
        return view('paises.edit', compact('pais'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => 'required|max:80',
            'clave' => 'required|max:5',
            'status' => 'required|integer'
        ]);
        $pais = Pais::findOrFail($id);
        $pais->update($request->all());
        return redirect()->route('paises.index')->with('success', 'País actualizado correctamente');
    }

    public function destroy($id) {
        $pais = Pais::findOrFail($id);
        $pais->delete();
        return redirect()->route('paises.index')->with('success', 'País eliminado correctamente');
    }
}