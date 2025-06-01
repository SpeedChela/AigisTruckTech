<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mensaje = 'Bienvenido ' . auth()->user()->nombre;
        if(auth()->user()->esSuperusuario()) {
            return redirect('/')->with('success', $mensaje . ' - Has iniciado sesión como Superusuario');
        } elseif(auth()->user()->esAdministrador()) {
            return redirect('/')->with('success', $mensaje . ' - Has iniciado sesión como Administrador');
        } elseif(auth()->user()->esEmpleado()) {
            return redirect('/')->with('success', $mensaje . ' - Has iniciado sesión como Empleado');
        } else {
            return redirect('/')->with('success', $mensaje . ' - Has iniciado sesión como Cliente');
        }
    }
}
