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
use App\Http\Controllers\EmailController;


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

// Ruta para actualizar teléfono de proveedor (debe ir ANTES de la ruta resource)
Route::post('/proveedores/{id}/actualizar-telefono', [ProveedoresController::class, 'actualizarTelefono'])->name('proveedores.actualizar-telefono');

Route::get('usa_control',[InicioController::class, 'usa_control_1']);
Route::get('usa_control_y_param/{var}', [InicioController::class, 'usa_control_y_param_1']);
Route::resource('paises', PaisesController::class);
Route::resource('estados', EstadosController::class);
Route::resource('municipios', MunicipiosController::class);
Route::resource('clientes', ClientesController::class);

// Rutas protegidas para Superusuario
Route::middleware(['auth', 'MDSuper'])->group(function () {
    Route::resource('usuarios', UsuariosController::class);
});

// Rutas protegidas para Administrador
Route::middleware(['auth', 'MDAdmin'])->group(function () {
    Route::resource('proveedores', ProveedoresController::class);
    Route::resource('refacciones', RefaccionesController::class);
});

// Rutas protegidas para Empleado
Route::middleware(['auth', 'MDEmp'])->group(function () {
    Route::resource('compras', ComprasController::class);
    Route::resource('compra_detalles', CompraDetallesController::class);
});

// Rutas protegidas para Cliente
Route::middleware(['auth', 'MDClien'])->group(function () {
    Route::resource('ventas', VentasController::class);
    Route::resource('venta_detalles', VentaDetallesController::class);
});

// Rutas AJAX
Route::get('combo_estado/{id_pais}', [AjaxController::class, 'cambia_combo_estado']);
Route::get('combo_municipio/{id_estado}', [AjaxController::class, 'cambia_combo_municipio']);
Route::get('/combo_estado/{pais_id}', [App\Http\Controllers\EstadoController::class, 'getEstadosByPais']);
Route::get('/combo_municipio/{estado_id}', [App\Http\Controllers\MunicipiosController::class, 'getMunicipiosByEstado']);

Route::get('form_enviar_correo', [EmailController::class, 'form_enviar_correo'])->name('form_enviar_correo');
Route::post('enviar_correo', [EmailController::class, 'enviar_correo'])->name('enviar_correo');

// Rutas de autenticación
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
