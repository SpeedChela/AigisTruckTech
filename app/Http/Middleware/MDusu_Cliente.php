<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MDusu_Cliente
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->esCliente()) {
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        return redirect()->route('home')->with('error', 'No tienes permisos de cliente para acceder a esta sección.');
    }
} 