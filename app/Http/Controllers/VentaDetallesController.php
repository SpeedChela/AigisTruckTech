<?php

namespace App\Http\Controllers;
use App\Models\Ventas;
use App\Models\Refacciones;
use App\Models\Detalles_ventas;
use App\Models\Venta_detalles;
use Illuminate\Http\Request;

class VentaDetallesController extends Controller
{
    public function index()
{
    $venta_detalles = \App\Models\Venta_detalles::all();
    return view('venta_detalles.index', [
        'titulo' => 'Detalles de Venta',
        'singular' => 'Detalle de Venta',
        'ruta' => 'venta_detalles',
        'columnas' => ['ID', 'Venta', 'Producto', 'Cantidad', 'Precio', 'Subtotal'],
        'campos' => ['id', 'id_venta', 'id_producto', 'cantidad', 'precio_individual', 'subtotal'],
        'registros' => $venta_detalles
    ]);
}

    public function create() {
    $ventas = Ventas::all();
    $refacciones = Refacciones::all();
    return view('venta_detalles.create', compact('ventas', 'refacciones'));
}

    public function store(Request $request) {
        $request->validate([
            'id_venta' => 'required|integer',
            'id_producto' => 'required|integer',
            'cantidad' => 'required|integer',
            'precio_individual' => 'required|numeric',
            'subtotal' => 'required|numeric'
        ]);
        Venta_detalles::create($request->all());
        return redirect()->route('venta_detalles.index')->with('success', 'Detalle de venta creado correctamente');
    }

   public function show($id) {
    $detalle_venta = Venta_detalles::findOrFail($id);
    return view('venta_detalles.read', compact('detalle_venta'));
}
    public function edit($id) {
    $detalle_venta = Venta_detalles::findOrFail($id);
    $ventas = Ventas::all();
    $refacciones = Refacciones::all();
    return view('venta_detalles.edit', compact('detalle_venta', 'ventas', 'refacciones'));
}

    public function update(Request $request, $id) {
        $request->validate([
            'id_venta' => 'required|integer',
            'id_producto' => 'required|integer',
            'cantidad' => 'required|integer',
            'precio_individual' => 'required|numeric',
            'subtotal' => 'required|numeric'
        ]);
        $detalle = Venta_detalles::findOrFail($id);
        $detalle->update($request->all());
        return redirect()->route('venta_detalles.index')->with('success', 'Detalle de venta actualizado correctamente');
    }

    public function destroy($id) {
        $detalle = Venta_detalles::findOrFail($id);
        $detalle->delete();
        return redirect()->route('venta_detalles.index')->with('success', 'Detalle de venta eliminado correctamente');
    }
}