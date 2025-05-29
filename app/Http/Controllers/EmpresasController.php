<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function index()
    {
    $empresas = \App\Models\Empresas::all();
    return view('empresas.index', [
        'titulo' => 'Empresas',
        'singular' => 'Empresa',
        'ruta' => 'empresas',
        'columnas' => ['ID', 'Usuario', 'Dirección', 'Teléfono', 'Correo', 'Status'],
        'campos' => ['id', 'id_usuario_up', 'direccion', 'telefono', 'correo', 'status'],
        'registros' => $empresas
    ]);
    }

    public function create() {
        $usuarios = Usuarios::all();
        return view('empresas.create', compact('usuarios'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_usuario_up' => 'required|integer',
            'direccion' => 'required|max:255',
            'mision' => 'nullable|string',
            'vision' => 'nullable|string',
            'valores' => 'nullable|string',
            'telefono' => 'nullable|max:20',
            'correo' => 'nullable|email|max:255',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'status' => 'required|integer'
        ]);
        Empresas::create($request->all());
        return redirect()->route('empresas.index')->with('success', 'Empresa creada correctamente');
    }

    public function show($id) {
        $empresa = Empresas::findOrFail($id);
        return view('empresas.read', compact('empresa'));
    }

    public function edit($id) {
        $empresa = Empresas::findOrFail($id);
        $usuarios = Usuarios::all();
        return view('empresas.edit', compact('empresa', 'usuarios'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'id_usuario_up' => 'required|integer',
            'direccion' => 'required|max:255',
            'mision' => 'nullable|string',
            'vision' => 'nullable|string',
            'valores' => 'nullable|string',
            'telefono' => 'nullable|max:20',
            'correo' => 'nullable|email|max:255',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'status' => 'required|integer'
        ]);
        $empresa = Empresas::findOrFail($id);
        $empresa->update($request->all());
        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada correctamente');
    }

    public function destroy($id) {
        $empresa = Empresas::findOrFail($id);
        $empresa->delete();
        return redirect()->route('empresas.index')->with('success', 'Empresa eliminada correctamente');
    }
}