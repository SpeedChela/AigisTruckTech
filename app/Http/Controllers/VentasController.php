<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\Usuarios;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Venta_detalles;
use App\Models\Refacciones;

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
        $usuarios = Usuarios::all();
        $clientes = Clientes::all();
        return view('ventas.create', compact('usuarios', 'clientes'));
    }

    public function store(Request $request)
    {
        try {
            // Validar datos requeridos
            if (!$request->has('cliente_id') || !$request->cliente_id) {
                return response()->json(['success' => false, 'message' => 'El ID del cliente es requerido'], 422);
            }

            if (!$request->has('productos') || empty($request->productos)) {
                return response()->json(['success' => false, 'message' => 'No hay productos en el carrito'], 422);
            }

            DB::beginTransaction();

            // Crear la venta
            $venta = new Ventas();
            $venta->id_cliente = $request->cliente_id;
            $venta->id_usuario = auth()->id();
            $venta->fecha_venta = now();
            $venta->status = 1;

            $subtotal = 0;
            foreach ($request->productos as $producto) {
                // Validar stock suficiente
                $refaccion = Refacciones::find($producto['id']);
                if (!$refaccion) {
                    DB::rollback();
                    return response()->json(['success' => false, 'message' => 'Producto no encontrado: ' . $producto['id']], 422);
                }

                if ($refaccion->stock < $producto['cantidad']) {
                    DB::rollback();
                    return response()->json(['success' => false, 'message' => 'Stock insuficiente para: ' . $refaccion->nombre], 422);
                }

                $subtotal += $producto['precio'] * $producto['cantidad'];
            }

            $venta->subtotal = $subtotal;
            $venta->iva = $subtotal * 0.16;
            $venta->total = $subtotal + $venta->iva;

            try {
                $venta->save();
            } catch (\Exception $e) {
                \Log::error('Error al guardar la venta: ' . $e->getMessage());
                DB::rollback();
                return response()->json(['success' => false, 'message' => 'Error al guardar la venta: ' . $e->getMessage()], 500);
            }

            // Crear los detalles de la venta
            foreach ($request->productos as $producto) {
                try {
                    $detalle = new Venta_detalles();
                    $detalle->id_venta = $venta->id;
                    $detalle->id_producto = $producto['id'];
                    $detalle->cantidad = $producto['cantidad'];
                    $detalle->precio_individual = $producto['precio'];
                    $detalle->subtotal = $producto['precio'] * $producto['cantidad'];
                    $detalle->save();

                    // Actualizar el stock
                    $refaccion = Refacciones::find($producto['id']);
                    $refaccion->stock -= $producto['cantidad'];
                    $refaccion->save();
                } catch (\Exception $e) {
                    \Log::error('Error al procesar producto: ' . json_encode($producto));
                    \Log::error('Error: ' . $e->getMessage());
                    DB::rollback();
                    return response()->json(['success' => false, 'message' => 'Error al procesar producto: ' . $e->getMessage()], 500);
                }
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Venta procesada correctamente']);

        } catch (\Exception $e) {
            \Log::error('Error general en venta: ' . $e->getMessage());
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Error al procesar la venta: ' . $e->getMessage()], 500);
        }
    }

    public function show($id) {
        $venta = Ventas::findOrFail($id);
        return view('ventas.read', compact('venta'));
    }

    public function edit($id) {
        $venta = Ventas::findOrFail($id);
        $usuarios = Usuarios::all();
        $clientes = Clientes::all();
        return view('ventas.edit', compact('venta', 'usuarios', 'clientes'));
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

    public function pos()
    {
        return view('ventas.pos');
    }
}