<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MDusu_Supervisor
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->esSupervisor()) {
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        return redirect('/')->with('error', 'No tienes permisos de supervisor para acceder a esta sección.');
    }
} 