<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refaccion;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\DetalleVenta;
use App\Models\DetalleCompra;
use App\Models\Proveedor;
use Carbon\Carbon;

class ReportesController extends Controller
{
    public function generarPDF($datos, $vistaurl, $tipo)
    {
        $data = $datos;
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo == 1) {
            return $pdf->stream('reporte');
        }
        if($tipo == 2) {
            return $pdf->download('reporte.pdf');
        }
    }

    // Reporte de Ventas por Período
    public function reporteVentas(Request $request, $tipo)
    {
        $fecha_inicio = $request->get('fecha_inicio', Carbon::now()->startOfMonth());
        $fecha_fin = $request->get('fecha_fin', Carbon::now());

        $vistaurl = "reportes.ventas_periodo";
        $ventas = Venta::with(['detalles.refaccion', 'cliente'])
                      ->where('status', 1)
                      ->whereBetween('fecha', [$fecha_inicio, $fecha_fin])
                      ->orderBy('fecha', 'desc')
                      ->get();

        return $this->generarPDF($ventas, $vistaurl, $tipo);
    }

    // Reporte de Compras por Período
    public function reporteCompras(Request $request, $tipo)
    {
        $fecha_inicio = $request->get('fecha_inicio', Carbon::now()->startOfMonth());
        $fecha_fin = $request->get('fecha_fin', Carbon::now());

        $vistaurl = "reportes.compras_periodo";
        $compras = Compra::with(['detalles.refaccion', 'proveedor'])
                        ->where('status', 1)
                        ->whereBetween('fecha', [$fecha_inicio, $fecha_fin])
                        ->orderBy('fecha', 'desc')
                        ->get();

        return $this->generarPDF($compras, $vistaurl, $tipo);
    }

    // Reporte de Inventario de Refacciones
    public function reporteInventario($tipo)
    {
        $vistaurl = "reportes.inventario";
        $refacciones = Refaccion::with('proveedor')
                               ->where('status', 1)
                               ->orderBy('stock', 'asc')
                               ->get();
        return $this->generarPDF($refacciones, $vistaurl, $tipo);
    }

    // Reporte de Proveedores y sus Productos
    public function reporteProveedores($tipo)
    {
        $vistaurl = "reportes.proveedores";
        $proveedores = Proveedor::with(['refacciones' => function($query) {
                                    $query->where('status', 1);
                                }])
                               ->where('status', 1)
                               ->orderBy('nombre')
                               ->get();
        return $this->generarPDF($proveedores, $vistaurl, $tipo);
    }
} 