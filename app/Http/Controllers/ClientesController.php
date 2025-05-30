<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Municipios;
use App\Models\Paises;
use App\Models\Estados;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Clientes::all();
        return view('clientes.index', [
            'titulo' => 'Clientes',
            'singular' => 'Cliente',
            'ruta' => 'clientes',
            'columnas' => ['ID', 'Nombre', 'Teléfono', 'Email', 'Municipio', 'Status'],
            'campos' => ['id', 'nombre', 'telefono', 'email', 'municipio_id', 'status'],
            'registros' => $clientes
        ]);
    }

    public function create()
    {
        $paises = Paises::where('status', 1)
                      ->orderBy('nombre')
                      ->get();
        
        return view('clientes.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:80',
            'telefono' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|max:255',
            'municipio_id' => 'required|integer',
            'codigo_postal' => 'nullable|max:10',
            'rfc' => 'nullable|max:20',
            'razon_social' => 'nullable|max:255',
            'direccion_fiscal' => 'nullable|max:255',
            'status' => 'required|integer'
        ]);
        
        Clientes::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    public function show($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.read', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Clientes::with(['municipio.estado'])->findOrFail($id);
        $paises = Paises::where('status', 1)
                      ->orderBy('nombre')
                      ->get();
        
        return view('clientes.edit', compact('cliente', 'paises'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:80',
            'telefono' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|max:255',
            'municipio_id' => 'required|integer',
            'codigo_postal' => 'nullable|max:10',
            'rfc' => 'nullable|max:20',
            'razon_social' => 'nullable|max:255',
            'direccion_fiscal' => 'nullable|max:255',
            'status' => 'required|integer'
        ]);
        
        $cliente = Clientes::findOrFail($id);
        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    public function destroy($id)
    {
        $cliente = Clientes::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }
}