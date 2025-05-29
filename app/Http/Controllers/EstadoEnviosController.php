<?php

namespace App\Http\Controllers;

use App\Models\Estado_envios;
use Illuminate\Http\Request;

class EstadoEnviosController extends Controller
{
    public function index()
{
    $estado_envios = \App\Models\Estado_envios::all();
    return view('estado_envios.index', [
        'titulo' => 'Estados de Envío',
        'singular' => 'Estado de Envío',
        'ruta' => 'estado_envios',
        'columnas' => ['ID', 'Compra', 'Status'],
        'campos' => ['id', 'id_compra', 'status'],
        'registros' => $estado_envios
    ]);
}

    public function create() {
        return view('estado_envios.create');
    }

    public function store(Request $request) {
        $request->validate([
            'id_compra' => 'required|integer',
            'status' => 'required|integer'
        ]);
        Estado_envios::create($request->all());
        return redirect()->route('estado_envios.index')->with('success', 'Estado de envío creado correctamente');
    }

    public function show($id) {
        $estado_envio = Estado_envios::findOrFail($id);
        return view('estado_envios.read', compact('estado_envio'));
    }

    public function edit($id) {
        $estado_envio = Estado_envios::findOrFail($id);
        return view('estado_envios.edit', compact('estado_envio'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'id_compra' => 'required|integer',
            'status' => 'required|integer'
        ]);
        $estado_envio = Estado_envios::findOrFail($id);
        $estado_envio->update($request->all());
        return redirect()->route('estado_envios.index')->with('success', 'Estado de envío actualizado correctamente');
    }

    public function destroy($id) {
        $estado_envio = Estado_envios::findOrFail($id);
        $estado_envio->delete();
        return redirect()->route('estado_envios.index')->with('success', 'Estado de envío eliminado correctamente');
    }
}