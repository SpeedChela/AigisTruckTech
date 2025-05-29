<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use App\Models\Municipios;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    public function index()
{
    $proveedores = \App\Models\Proveedores::all();
    return view('proveedores.index', [
        'titulo' => 'Proveedores',
        'singular' => 'Proveedor',
        'ruta' => 'proveedores',
        'columnas' => ['ID', 'Nombre', 'Teléfono', 'Email', 'Municipio', 'Status'],
        'campos' => ['id', 'nombre', 'telefono', 'email', 'municipio_id', 'status'],
        'registros' => $proveedores
    ]);
}

    public function create() {
    $municipios = Municipios::all();
    return view('proveedores.create', compact('municipios'));
}

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|max:80',
            'telefono' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|max:255',
            'municipio_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        Proveedores::create($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado correctamente');
    }

    public function show($id) {
        $proveedor = Proveedores::findOrFail($id);
        return view('proveedores.read', compact('proveedor'));
    }

    public function edit($id) {
    $proveedor = Proveedores::findOrFail($id);
    $municipios = Municipios::all();
    return view('proveedores.edit', compact('proveedor', 'municipios'));
}

    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => 'required|max:80',
            'telefono' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|max:255',
            'municipio_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->update($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente');
    }

    public function destroy($id) {
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente');
    }
}