<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function index()
{
    $ventas = \App\Models\Ventas::all();
    return view('ventas.index', [
        'titulo' => 'Ventas',
        'singular' => 'Venta',
        'ruta' => 'ventas',
        'columnas' => ['ID', 'Usuario', 'Cliente', 'Fecha', 'Total', 'Status'],
        'campos' => ['id', 'id_usuario', 'id_cliente', 'fecha_venta', 'total', 'status'],
        'registros' => $ventas
    ]);
}

    public function create() {
        return view('ventas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'id_usuario' => 'required|integer',
            'id_cliente' => 'required|integer',
            'fecha_venta' => 'required|date',
            'total' => 'required|numeric',
            'status' => 'required|integer'
        ]);
        Ventas::create($request->all());
        return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente');
    }

    public function show($id) {
        $venta = Ventas::findOrFail($id);
        return view('ventas.read', compact('venta'));
    }

    public function edit($id) {
        $venta = Ventas::findOrFail($id);
        return view('ventas.edit', compact('venta'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'id_usuario' => 'required|integer',
            'id_cliente' => 'required|integer',
            'fecha_venta' => 'required|date',
            'total' => 'required|numeric',
            'status' => 'required|integer'
        ]);
        $venta = Ventas::findOrFail($id);
        $venta->update($request->all());
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente');
    }

    public function destroy($id) {
        $venta = Ventas::findOrFail($id);
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente');
    }
}