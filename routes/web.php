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
    GraficasController,
    FotosProductosController
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
    Route::get('/reportes/compras/{tipo}', [ReportesController::class, 'reporteCompras'])->name('reportes.compras');
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
    Route::get('/reportes/compras/{tipo}', [ReportesController::class, 'reporteCompras'])->name('reportes.compras');
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

// Rutas para la tienda
Route::get('/tienda', [App\Http\Controllers\ProductoController::class, 'tienda'])->name('tienda');

// Rutas para la administración de productos
Route::resource('productos', App\Http\Controllers\ProductoController::class);
Route::delete('/productos/foto/{id}', [App\Http\Controllers\ProductoController::class, 'eliminarFoto'])->name('productos.eliminarFoto');
Route::post('/productos/foto/{id}/principal', [App\Http\Controllers\ProductoController::class, 'establecerFotoPrincipal'])->name('productos.establecerFotoPrincipal');

// Rutas para la tienda de refacciones
Route::get('/tienda-refacciones', [App\Http\Controllers\RefaccionesController::class, 'tienda'])->name('refacciones.tienda');

// Rutas para la gestión de fotos de productos
Route::resource('fotos_productos', FotosProductosController::class);

// API Routes para Ajax
Route::prefix('api')->group(function () {
    Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'obtenerProductos']);
    Route::get('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'obtenerDetalleProducto']);
    Route::get('/refacciones', [App\Http\Controllers\RefaccionesController::class, 'obtenerRefacciones']);
    Route::get('/refacciones/{id}', [App\Http\Controllers\RefaccionesController::class, 'obtenerDetalleRefaccion']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
