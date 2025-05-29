<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;

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
