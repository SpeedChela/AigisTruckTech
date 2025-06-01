<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refaccion;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Proveedor;

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
    public function reporteVentas($tipo)
    {
        $vistaurl = "reportes.ventas_periodo";
        $ventas = Venta::with(['detalles', 'cliente'])
                      ->where('status', 1)
                      ->orderBy('fecha', 'desc')
                      ->get();
        return $this->generarPDF($ventas, $vistaurl, $tipo);
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