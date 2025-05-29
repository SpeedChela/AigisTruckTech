<?php

namespace App\Http\Controllers;

use App\Models\Refacciones;
use Illuminate\Http\Request;

class RefaccionesController extends Controller
{
    public function index()
{
    $refacciones = \App\Models\Refacciones::all();
    return view('refacciones.index', [
        'titulo' => 'Refacciones',
        'singular' => 'Refacción',
        'ruta' => 'refacciones',
        'columnas' => ['ID', 'Proveedor', 'Nombre', 'Marca', 'Precio', 'Stock', 'Status'],
        'campos' => ['id', 'id_proveedor', 'nombre', 'marca', 'precio', 'stock', 'status'],
        'registros' => $refacciones
    ]);
}

    public function create() {
        return view('refacciones.create');
    }

    public function store(Request $request) {
        $request->validate([
            'id_proveedor' => 'required|integer',
            'nombre' => 'required|max:80',
            'marca' => 'nullable|max:80',
            'categoria' => 'nullable|max:80',
            'tipo_refaccion' => 'nullable|max:80',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'cant_existente' => 'required|integer',
            'status' => 'required|integer'
        ]);
        Refacciones::create($request->all());
        return redirect()->route('refacciones.index')->with('success', 'Refacción creada correctamente');
    }

    public function show($id) {
        $refaccion = Refacciones::findOrFail($id);
        return view('refacciones.read', compact('refaccion'));
    }

    public function edit($id) {
        $refaccion = Refacciones::findOrFail($id);
        return view('refacciones.edit', compact('refaccion'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'id_proveedor' => 'required|integer',
            'nombre' => 'required|max:80',
            'marca' => 'nullable|max:80',
            'categoria' => 'nullable|max:80',
            'tipo_refaccion' => 'nullable|max:80',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'cant_existente' => 'required|integer',
            'status' => 'required|integer'
        ]);
        $refaccion = Refacciones::findOrFail($id);
        $refaccion->update($request->all());
        return redirect()->route('refacciones.index')->with('success', 'Refacción actualizada correctamente');
    }

    public function destroy($id) {
        $refaccion = Refacciones::findOrFail($id);
        $refaccion->delete();
        return redirect()->route('refacciones.index')->with('success', 'Refacción eliminada correctamente');
    }
}