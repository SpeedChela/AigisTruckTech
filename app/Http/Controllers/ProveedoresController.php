<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use App\Models\Municipios;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    public function index()
{
    $proveedores = \App\Models\Proveedores::all();
    return view('proveedores.index', [
        'titulo' => 'Proveedores',
        'singular' => 'Proveedor',
        'ruta' => 'proveedores',
        'columnas' => ['ID', 'Nombre', 'Teléfono', 'Email', 'Municipio', 'Status'],
        'campos' => ['id', 'nombre', 'telefono', 'email', 'municipio_id', 'status'],
        'registros' => $proveedores
    ]);
}

    public function create() {
    $municipios = Municipios::all();
    return view('proveedores.create', compact('municipios'));
}

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|max:80',
            'telefono' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|max:255',
            'municipio_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        Proveedores::create($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado correctamente');
    }

    public function show($id) {
        $proveedor = Proveedores::findOrFail($id);
        return view('proveedores.read', compact('proveedor'));
    }

    public function edit($id) {
    $proveedor = Proveedores::findOrFail($id);
    $municipios = Municipios::all();
    return view('proveedores.edit', compact('proveedor', 'municipios'));
}

    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => 'required|max:80',
            'telefono' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|max:255',
            'municipio_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->update($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente');
    }

    public function destroy($id) {
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente');
    }

    public function actualizarTelefono(Request $request, $id)
    {
        try {
            \Log::info('Actualizando teléfono para proveedor ID: ' . $id);
            \Log::info('Datos recibidos:', $request->all());

            $request->validate([
                'telefono' => 'nullable|max:20'
            ]);

        $proveedor = \App\Models\Proveedores::findOrFail($id);
            $telefonoAnterior = $proveedor->telefono;
        $proveedor->telefono = $request->telefono;
        $proveedor->save();

            \Log::info('Teléfono actualizado correctamente', [
                'id' => $id,
                'telefono_anterior' => $telefonoAnterior,
                'telefono_nuevo' => $proveedor->telefono
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Teléfono actualizado correctamente',
                'telefono' => $proveedor->telefono
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('Proveedor no encontrado', ['id' => $id]);
            return response()->json([
                'success' => false,
                'message' => 'Proveedor no encontrado'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Error de validación', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Error de validación: ' . $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error al actualizar teléfono', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el teléfono: ' . $e->getMessage()
            ], 500);
        }
    }
}