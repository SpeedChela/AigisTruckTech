<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\{
    PaisesController,
    EstadosController,
    MunicipiosController,
    ClientesController,
    ProveedoresController,
    RefaccionesController,
    ComprasController,
    CompraDetallesController,
    VentasController,
    VentaDetallesController,
    EstadoEnviosController,
    UsuariosController,
    GraficasController
};

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ReporteEmailController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas básicas
Route::get('/', function () {
    return view('template.master');
});

Route::get('inicio', function () {
    return view('inicio_vista');
});

// Rutas protegidas para Superusuario (tiene acceso a todo)
Route::middleware(['auth', 'MDusu_Superusuario'])->group(function () {
    // Gestión de ubicaciones
    Route::resource('paises', PaisesController::class);
    Route::resource('estados', EstadosController::class);
    Route::resource('municipios', MunicipiosController::class);
    
    // Gestión de clientes y proveedores
    Route::resource('clientes', ClientesController::class);
    Route::resource('proveedores', ProveedoresController::class);
    Route::post('/proveedores/{id}/actualizar-telefono', [ProveedoresController::class, 'actualizarTelefono'])
        ->name('proveedores.actualizar-telefono');
    
    
    // Gestión de refacciones
    Route::resource('refacciones', RefaccionesController::class);
    
    // Gestión de compras
    Route::resource('compras', ComprasController::class);
    Route::resource('compra_detalles', CompraDetallesController::class);
    
    // Gestión de ventas
    Route::resource('ventas', VentasController::class);
    Route::resource('venta_detalles', VentaDetallesController::class);
    
    // Reportes y gráficas
    Route::get('/reportes/ventas/{tipo}', [ReportesController::class, 'reporteVentas'])->name('reportes.ventas');
    Route::get('/reportes/inventario/{tipo}', [ReportesController::class, 'reporteInventario'])->name('reportes.inventario');
    Route::get('/reportes/proveedores/{tipo}', [ReportesController::class, 'reporteProveedores'])->name('reportes.proveedores');
    Route::get('/graficas', [GraficasController::class, 'index'])->name('graficas.index');
    Route::get('/graficas/ventas-mes', [GraficasController::class, 'ventasPorMes'])->name('graficas.ventas_mes');
    Route::get('/graficas/stock-refacciones', [GraficasController::class, 'stockRefacciones'])->name('graficas.stock_refacciones');
    Route::get('/graficas/proveedores-productos', [GraficasController::class, 'proveedoresProductos'])->name('graficas.proveedores_productos');
    
    // Reportes por correo
    Route::get('/reportes/email', [ReporteEmailController::class, 'index'])->name('reportes.email.form');
    Route::post('/reportes/email/enviar', [ReporteEmailController::class, 'enviarReporte'])->name('reportes.email.enviar');
    // Gestión de usuarios (exclusivo superusuario)
    Route::resource('usuarios', UsuariosController::class);
    
});

// Rutas protegidas para Administrador y superiores
Route::middleware(['auth', 'MDusu_Administrador'])->group(function () {
    // Gestión de ubicaciones
    Route::resource('paises', PaisesController::class);
    Route::resource('estados', EstadosController::class);
    Route::resource('municipios', MunicipiosController::class);
    
    // Gestión de clientes y proveedores
    Route::resource('clientes', ClientesController::class);
    Route::resource('proveedores', ProveedoresController::class);
    Route::post('/proveedores/{id}/actualizar-telefono', [ProveedoresController::class, 'actualizarTelefono'])
        ->name('proveedores.actualizar-telefono');
    
    // Gestión de refacciones
    Route::resource('refacciones', RefaccionesController::class);
    
    // Gestión de compras
    Route::resource('compras', ComprasController::class);
    Route::resource('compra_detalles', CompraDetallesController::class);
    
    // Gestión de ventas
    Route::resource('ventas', VentasController::class);
    Route::resource('venta_detalles', VentaDetallesController::class);
    
    // Reportes y gráficas
    Route::get('/reportes/ventas/{tipo}', [ReportesController::class, 'reporteVentas'])->name('reportes.ventas');
    Route::get('/reportes/inventario/{tipo}', [ReportesController::class, 'reporteInventario'])->name('reportes.inventario');
    Route::get('/reportes/proveedores/{tipo}', [ReportesController::class, 'reporteProveedores'])->name('reportes.proveedores');
    Route::get('/graficas', [GraficasController::class, 'index'])->name('graficas.index');
    Route::get('/graficas/ventas-mes', [GraficasController::class, 'ventasPorMes'])->name('graficas.ventas_mes');
    Route::get('/graficas/stock-refacciones', [GraficasController::class, 'stockRefacciones'])->name('graficas.stock_refacciones');
    Route::get('/graficas/proveedores-productos', [GraficasController::class, 'proveedoresProductos'])->name('graficas.proveedores_productos');
    
    // Reportes por correo
    Route::get('/reportes/email', [ReporteEmailController::class, 'index'])->name('reportes.email.form');
    Route::post('/reportes/email/enviar', [ReporteEmailController::class, 'enviarReporte'])->name('reportes.email.enviar');
});

// Rutas protegidas para Empleado
Route::middleware(['auth', 'MDusu_Empleado'])->group(function () {
    // Gestión de inventario
    Route::resource('refacciones', RefaccionesController::class);
    
    // Gestión de compras
    Route::resource('compras', ComprasController::class);
    Route::resource('compra_detalles', CompraDetallesController::class);
    
    // Gestión de ventas
    Route::resource('ventas', VentasController::class);
    Route::resource('venta_detalles', VentaDetallesController::class);
    
    // Reportes por correo
    Route::get('/reportes/email', [ReporteEmailController::class, 'index'])->name('reportes.email.form');
    Route::post('/reportes/email/enviar', [ReporteEmailController::class, 'enviarReporte'])->name('reportes.email.enviar');
});

// Rutas protegidas para Cliente (sin permisos por ahora)
Route::middleware(['auth', 'MDusu_Cliente'])->group(function () {
    // Sin rutas por ahora
});

// Rutas AJAX
Route::middleware(['auth'])->group(function () {
    Route::get('combo_estado/{id_pais}', [AjaxController::class, 'cambia_combo_estado']);
    Route::get('combo_municipio/{id_estado}', [AjaxController::class, 'cambia_combo_municipio']);
});

// Rutas para gráficas (accesibles para todos los usuarios autenticados)
Route::middleware(['auth'])->prefix('graficas')->name('graficas.')->group(function () {
    Route::get('/', [GraficasController::class, 'index'])->name('index');
    Route::get('/ventas-periodo', [GraficasController::class, 'ventasPorPeriodo'])->name('ventas_mes');
    Route::get('/refacciones-movimientos', [GraficasController::class, 'refaccionesMovimientos'])->name('refacciones_movimientos');
    Route::get('/compras-vs-ventas', [GraficasController::class, 'comprasVsVentas'])->name('compras_vs_ventas');
});

// Rutas para correo (accesibles para usuarios autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/form_enviar_correo', [EmailController::class, 'form_enviar_correo'])->name('form_enviar_correo');
    Route::post('/enviar_correo', [EmailController::class, 'enviar_correo'])->name('enviar_correo');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
