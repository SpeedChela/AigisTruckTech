<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refaccion;
use App\Models\Venta;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Mail;
use PDF;

class ReporteEmailController extends Controller
{
    public function index()
    {
        return view('reportes.email.form');
    }

    public function enviarReporte(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'tipo_reporte' => 'required|in:ventas,inventario,proveedores'
        ]);

        $email = $request->email;
        $tipo_reporte = $request->tipo_reporte;

        try {
            // Generar el PDF según el tipo de reporte
            switch ($tipo_reporte) {
                case 'ventas':
                    $ventas = Venta::with(['detalles', 'cliente'])
                        ->where('status', 1)
                        ->orderBy('fecha', 'desc')
                        ->get();
                    $data = $ventas;
                    $view = 'reportes.ventas_periodo';
                    $titulo = 'Reporte de Ventas';
                    break;

                case 'inventario':
                    $refacciones = Refaccion::with('proveedor')
                        ->where('status', 1)
                        ->orderBy('stock', 'asc')
                        ->get();
                    $data = $refacciones;
                    $view = 'reportes.inventario';
                    $titulo = 'Reporte de Inventario';
                    break;

                case 'proveedores':
                    $proveedores = Proveedor::with(['refacciones' => function($query) {
                        $query->where('status', 1);
                    }])
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
                    $data = $proveedores;
                    $view = 'reportes.proveedores';
                    $titulo = 'Reporte de Proveedores';
                    break;
            }

            $date = date('Y-m-d');
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView($view, compact('data', 'date'));

            // Enviar el correo con el PDF adjunto
            Mail::send('reportes.email.mensaje', ['tipo' => $titulo], function($message) use ($pdf, $email, $titulo) {
                $message->to($email)
                        ->subject($titulo . ' - Aigis Truck Tech')
                        ->attachData($pdf->output(), $titulo . '.pdf');
            });

            return redirect()->back()->with('success', 'El reporte ha sido enviado correctamente a ' . $email);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al enviar el reporte: ' . $e->getMessage());
        }
    }
} 