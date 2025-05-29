<?php

namespace App\Http\Controllers;

use App\Models\Compra_detalles;
use App\Models\Compras;
use App\Models\Refacciones;
use Illuminate\Http\Request;

class CompraDetallesController extends Controller
{
    public function index()
{
    $compra_detalles = \App\Models\Compra_detalles::all();
    return view('compra_detalles.index', [
        'titulo' => 'Detalles de Compra',
        'singular' => 'Detalle de Compra',
        'ruta' => 'compra_detalles',
        'columnas' => ['ID', 'Compra', 'Producto', 'Cantidad', 'Precio', 'Subtotal'],
        'campos' => ['id', 'id_compra', 'id_producto', 'cantidad', 'precio_individual', 'subtotal'],
        'registros' => $compra_detalles
    ]);
}

    public function create() {
    $compras = Compras::all();
    $refacciones = Refacciones::all();
    return view('compra_detalles.create', compact('compras', 'refacciones'));
}

    public function store(Request $request) {
        $request->validate([
            'id_compra' => 'required|integer',
            'id_producto' => 'required|integer',
            'cantidad' => 'required|integer',
            'precio_individual' => 'required|numeric',
            'subtotal' => 'required|numeric'
        ]);
        Compra_detalles::create($request->all());
        return redirect()->route('compra_detalles.index')->with('success', 'Detalle de compra creado correctamente');
    }

    public function show($id) {
    $compra_detalles = Compra_detalles::findOrFail($id);
    return view('compra_detalles.read', compact('compra_detalles'));
    }

    public function edit($id) {
        $compra_detalle = Compra_detalles::findOrFail($id);
        $compras = Compras::all();
        $refacciones = Refacciones::all();
        return view('compra_detalles.edit', compact('compra_detalle', 'compras', 'refacciones'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'id_compra' => 'required|integer',
            'id_producto' => 'required|integer',
            'cantidad' => 'required|integer',
            'precio_individual' => 'required|numeric',
            'subtotal' => 'required|numeric'
        ]);
        $detalle = Compra_detalles::findOrFail($id);
        $detalle->update($request->all());
        return redirect()->route('compra_detalles.index')->with('success', 'Detalle de compra actualizado correctamente');
    }

    public function destroy($id) {
        $detalle = Compra_detalles::findOrFail($id);
        $detalle->delete();
        return redirect()->route('compra_detalles.index')->with('success', 'Detalle de compra eliminado correctamente');
    }
}