<?php

namespace App\Http\Controllers;
use App\Models\Ventas;
use App\Models\Refacciones;
use App\Models\Detalles_ventas;
use App\Models\Venta_detalles;
use Illuminate\Http\Request;

class Venta_detallesController extends Controller
{
    public function index()
    {
        $venta_detalles = Venta_detalles::all();
        return view('venta_detalles.index', [
            'titulo' => 'Detalles de Venta',
            'singular' => 'Detalle de Venta',
            'ruta' => 'venta_detalles',
            'columnas' => ['ID', 'Venta', 'Producto', 'Cantidad', 'Precio', 'Subtotal'],
            'campos' => ['id', 'id_venta', 'id_producto', 'cantidad', 'precio_individual', 'subtotal'],
            'registros' => $venta_detalles
        ]);
    }

    public function create()
    {
        $ventas = Ventas::all();
        $refacciones = Refacciones::all();
        return view('venta_detalles.create', compact('ventas', 'refacciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_venta' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required',
            'precio_individual' => 'required',
            'subtotal' => 'required'
        ]);

        Venta_detalles::create($request->all());
        return redirect()->route('venta_detalles.index')->with('success', 'Detalle de venta creado correctamente');
    }

    public function show(Venta_detalles $venta_detalle)
    {
        return view('venta_detalles.read', compact('venta_detalle'));
    }

    public function edit(Venta_detalles $venta_detalle)
    {
        $ventas = Ventas::all();
        $refacciones = Refacciones::all();
        return view('venta_detalles.edit', compact('venta_detalle', 'ventas', 'refacciones'));
    }

    public function update(Request $request, Venta_detalles $venta_detalle)
    {
        $request->validate([
            'id_venta' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required',
            'precio_individual' => 'required',
            'subtotal' => 'required'
        ]);

        $venta_detalle->update($request->all());
        return redirect()->route('venta_detalles.index')->with('success', 'Detalle de venta actualizado correctamente');
    }

    public function destroy(Venta_detalles $venta_detalle)
    {
        $venta_detalle->delete();
        return redirect()->route('venta_detalles.index')->with('success', 'Detalle de venta eliminado correctamente');
    }
}