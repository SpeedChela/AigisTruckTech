<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refacciones;
use App\Models\Ventas;
use App\Models\Compras;
use App\Models\Proveedor;
use App\Models\Venta_detalles;
use App\Models\Compra_detalles;
use Illuminate\Support\Facades\DB;

class GraficasController extends Controller
{
    // Vista principal de gráficas
    public function index()
    {
        return view('graficas.index');
    }

    // Gráfica de Ventas por Período
    public function ventasPorPeriodo(Request $request)
    {
        $periodo = $request->input('periodo', 'mes'); // mes, semana, año
        $fecha_inicio = $request->input('fecha_inicio', now()->subMonths(6)->format('Y-m-d'));
        $fecha_fin = $request->input('fecha_fin', now()->format('Y-m-d'));

        $ventas = Ventas::select(
            DB::raw('DATE(fecha_venta) as fecha'),
            DB::raw('SUM(total) as total_ventas'),
            DB::raw('COUNT(*) as numero_ventas')
        )
        ->whereBetween('fecha_venta', [$fecha_inicio, $fecha_fin])
        ->where('status', 1)
        ->groupBy(DB::raw('DATE(fecha_venta)'))
        ->orderBy('fecha_venta')
        ->get();

        if ($request->ajax()) {
            return response()->json(['ventas' => $ventas]);
        }

        return view('graficas.ventas_periodo', compact('ventas', 'periodo', 'fecha_inicio', 'fecha_fin'));
    }

    // Gráfica de Stock y Movimientos de Refacciones
    public function refaccionesMovimientos(Request $request)
    {
        try {
            $tipo_vista = $request->input('tipo_vista', 'stock'); // stock, movimientos
            $limite = $request->input('limite', 10);
            
            if ($tipo_vista === 'stock') {
                $refacciones = Refacciones::select(
                    'refacciones.id',
                    'refacciones.nombre',
                    'refacciones.stock',
                    DB::raw('COALESCE((SELECT COUNT(*) FROM venta_detalles WHERE id_producto = refacciones.id), 0) as total_ventas'),
                    DB::raw('COALESCE((SELECT COUNT(*) FROM compra_detalles WHERE id_producto = refacciones.id), 0) as total_compras')
                )
                ->where('refacciones.status', 1)
                ->orderBy('stock', 'desc')
                ->take($limite)
                ->get();
            } else {
                $refacciones = Refacciones::select(
                    'refacciones.id',
                    'refacciones.nombre',
                    DB::raw('COALESCE((SELECT SUM(cantidad) FROM venta_detalles WHERE id_producto = refacciones.id), 0) as total_vendido'),
                    DB::raw('COALESCE((SELECT SUM(cantidad) FROM compra_detalles WHERE id_producto = refacciones.id), 0) as total_comprado')
                )
                ->where('refacciones.status', 1)
                ->orderByRaw('(SELECT SUM(cantidad) FROM venta_detalles WHERE id_producto = refacciones.id) DESC NULLS LAST')
                ->take($limite)
                ->get();
            }

            if ($request->ajax()) {
                return response()->json([
                    'refacciones' => $refacciones,
                    'tipo_vista' => $tipo_vista
                ]);
            }

            return view('graficas.refacciones_movimientos', compact('refacciones', 'tipo_vista', 'limite'));
        } catch (\Exception $e) {
            \Log::error('Error en refaccionesMovimientos: ' . $e->getMessage());
            return response()->json(['error' => 'Error al cargar los datos'], 500);
        }
    }

    // Gráfica de Compras vs Ventas
    public function comprasVsVentas(Request $request)
    {
        $periodo = $request->input('periodo', 'mensual'); // diario, mensual, anual
        $año = $request->input('año', date('Y'));
        $mes = $request->input('mes', date('m'));

        $compras = Compras::select(
            DB::raw('DATE(fecha_compra) as fecha'),
            DB::raw('SUM(total) as total_compras')
        )
        ->whereYear('fecha_compra', $año)
        ->when($periodo === 'mensual', function($query) use ($mes) {
            return $query->whereMonth('fecha_compra', $mes);
        })
        ->where('status', 1)
        ->groupBy(DB::raw('DATE(fecha_compra)'))
        ->orderBy('fecha_compra')
        ->get();

        $ventas = Ventas::select(
            DB::raw('DATE(fecha_venta) as fecha'),
            DB::raw('SUM(total) as total_ventas')
        )
        ->whereYear('fecha_venta', $año)
        ->when($periodo === 'mensual', function($query) use ($mes) {
            return $query->whereMonth('fecha_venta', $mes);
        })
        ->where('status', 1)
        ->groupBy(DB::raw('DATE(fecha_venta)'))
        ->orderBy('fecha_venta')
        ->get();

        if ($request->ajax()) {
            return response()->json([
                'compras' => $compras,
                'ventas' => $ventas
            ]);
        }

        return view('graficas.compras_vs_ventas', compact('compras', 'ventas', 'periodo', 'año', 'mes'));
    }

    // Gráfica de Stock de Refacciones
    public function stockRefacciones()
    {
        $refacciones = Refacciones::where('status', 1)
            ->orderBy('stock', 'desc')
            ->take(10)
            ->get();

        return view('graficas.stock_refacciones', compact('refacciones'));
    }

    // Gráfica de Proveedores y Cantidad de Productos
    public function proveedoresProductos()
    {
        $proveedores = Proveedor::withCount(['refacciones' => function($query) {
            $query->where('status', 1);
        }])
        ->where('status', 1)
        ->orderBy('refacciones_count', 'desc')
        ->get();

        return view('graficas.proveedores_productos', compact('proveedores'));
    }
} 