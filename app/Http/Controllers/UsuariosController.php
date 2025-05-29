<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\Paises;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
public function index(Request $request)
{
    $query = \App\Models\Usuarios::query();

    // Filtros
    if ($request->filled('nombre')) {
        $query->where('nombre', 'like', '%' . $request->nombre . '%');
    }
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }
    if ($request->filled('rol')) {
        $query->where('rol', $request->rol);
    }
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $usuarios = $query->get();

    return view('usuarios.index', [
        'titulo' => 'Usuarios',
        'singular' => 'Usuario',
        'ruta' => 'usuarios',
        'columnas' => ['ID', 'Nombre', 'Email', 'Teléfono', 'Rol', 'Status'],
        'campos' => ['id', 'nombre', 'email', 'telefono', 'rol', 'status'],
        'registros' => $usuarios
    ]);
}

public function create()
{
    // Trae todos los países activos
    $paises = \App\Models\Paises::select('id','nombre')
        ->where('status', 1)
        ->orderBy('nombre')
        ->get();

    // Retorna la vista con los países
    return view('usuarios.create')
        ->with('paises', $paises);
        // ->with('roles', $roles); // Solo si quieres usar roles desde el controlador
}

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|max:80',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
            'telefono' => 'nullable|max:20',
            'rol' => 'required|integer',
            'status' => 'required|integer'
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        Usuarios::create($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    public function show($id) {
        $usuario = Usuarios::findOrFail($id);
        return view('usuarios.read', compact('usuario'));
    }

    public function edit($id)
{
    $usuario = \App\Models\Usuarios::findOrFail($id);
    $paises = \App\Models\Paises::select('id','nombre')
        ->where('status', 1)
        ->orderBy('nombre')->get();

    return view('usuarios.edit')
        ->with('usuario', $usuario)
        ->with('paises', $paises);
}

    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => 'required|max:80',
            'email' => 'required|email|max:255',
            'password' => 'nullable|max:255',
            'telefono' => 'nullable|max:20',
            'rol' => 'required|integer',
            'status' => 'required|integer'
        ]);
        $usuario = Usuarios::findOrFail($id);
        $data = $request->all();
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $usuario->update($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id) {
        $usuario = Usuarios::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }

}