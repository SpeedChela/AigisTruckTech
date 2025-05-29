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
    UsuariosController
};

use App\Http\Controllers\AjaxController;


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



Route::get('usa_control',[InicioController::class, 'usa_control_1']);
Route::get('usa_control_y_param/{var}', [InicioController::class, 'usa_control_y_param_1']);
Route::resource('paises', PaisesController::class);
Route::resource('estados', EstadosController::class);
Route::resource('municipios', MunicipiosController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('proveedores', ProveedoresController::class);
Route::post('proveedores/{id}/actualizar-telefono', [ProveedoresController::class, 'actualizarTelefono']);
Route::resource('refacciones', RefaccionesController::class);
Route::resource('compras', ComprasController::class);
Route::resource('compra_detalles', CompraDetallesController::class);
Route::resource('ventas', VentasController::class);
Route::resource('venta_detalles', VentaDetallesController::class);
Route::resource('estado_envios', EstadoEnviosController::class);
Route::resource('usuarios', UsuariosController::class);

// Rutas AJAX
Route::get('combo_estado/{id_pais}', [AjaxController::class, 'cambia_combo_estado']);
Route::get('combo_municipio/{id_estado}', [AjaxController::class, 'cambia_combo_municipio']);
