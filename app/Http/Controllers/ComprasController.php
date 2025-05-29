<?php

namespace App\Http\Controllers;

use App\Models\Compras;
use App\Models\Proveedores;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    public function index()
{
    $compras = \App\Models\Compras::all();
    return view('compras.index', [
        'titulo' => 'Compras',
        'singular' => 'Compra',
        'ruta' => 'compras',
        'columnas' => ['ID', 'Proveedor', 'Usuario', 'Fecha', 'Total', 'Status'],
        'campos' => ['id', 'id_proveedor', 'id_usuario', 'fecha_compra', 'total', 'status'],
        'registros' => $compras
    ]);
}

    public function create() {
        $proveedores = Proveedores::all();
        $usuarios = Usuarios::all();
        return view('compras.create', compact('proveedores', 'usuarios'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_proveedor' => 'required|integer',
            'id_usuario' => 'required|integer',
            'fecha_compra' => 'required|date',
            'total' => 'required|numeric',
            'status' => 'required|integer'
        ]);
        Compras::create($request->all());
        return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');
    }

    public function show($id) {
        $compra = Compras::findOrFail($id);
        return view('compras.read', compact('compra'));
    }

    public function edit($id) {
        $compra = Compras::findOrFail($id);
        $proveedores = Proveedores::all();
        $usuarios = Usuarios::all();
        return view('compras.edit', compact('compra', 'proveedores', 'usuarios'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'id_proveedor' => 'required|integer',
            'id_usuario' => 'required|integer',
            'fecha_compra' => 'required|date',
            'total' => 'required|numeric',
            'status' => 'required|integer'
        ]);
        $compra = Compras::findOrFail($id);
        $compra->update($request->all());
        return redirect()->route('compras.index')->with('success', 'Compra actualizada correctamente');
    }

    public function destroy($id) {
        $compra = Compras::findOrFail($id);
        $compra->delete();
        return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente');
    }
}