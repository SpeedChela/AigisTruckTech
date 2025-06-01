<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MDusu_Administrador
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->esAdministrador()) {
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        return redirect()->route('home')->with('error', 'No tienes permisos de administrador para acceder a esta sección.');
    }
} 