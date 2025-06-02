<?php

namespace App\Http\Controllers;

use App\Models\Refacciones;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RefaccionesController extends Controller
{
    public function index()
    {
        $refacciones = Refacciones::where('status', 1)
                      ->orderBy('id_proveedor')
                      ->orderBy('nombre')->get();          
        return view('refacciones.index', compact('refacciones'));
    }

    public function tienda()
    {
        return view('refacciones.tienda');
    }

    public function create()
    {
        $proveedores = Proveedores::where('status', 1)
                      ->orderBy('nombre')->get();
        return view('refacciones.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_proveedor' => 'required|integer',
            'nombre' => 'required|max:80',
            'marca' => 'nullable|max:80',
            'categoria' => 'nullable|max:80',
            'tipo_refaccion' => 'nullable|max:80',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'cant_existente' => 'required|integer',
            'status' => 'required|integer',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $refaccion = Refacciones::create($request->except('fotos'));

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $foto) {
                $nombreArchivo = time() . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('public/refacciones', $nombreArchivo);

                // Aquí deberías crear un registro en la tabla fotos_refacciones si la tienes
                // Por ahora solo guardamos la primera foto en el campo foto de la refacción
                if ($index === 0) {
                    $refaccion->foto = $nombreArchivo;
                    $refaccion->save();
                }
            }
        }

        return redirect()->route('refacciones.index')->with('success', 'Refacción creada exitosamente');
    }

    public function show($id)
    {
        $refaccion = Refacciones::findOrFail($id);
        return view('refacciones.read', compact('refaccion'));
    }

    public function edit($id)
    {
        $refaccion = Refacciones::findOrFail($id);
        $proveedores = Proveedores::where('status', 1)
                      ->orderBy('nombre')->get();
        return view('refacciones.edit', compact('refaccion', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_proveedor' => 'required|integer',
            'nombre' => 'required|max:80',
            'marca' => 'nullable|max:80',
            'categoria' => 'nullable|max:80',
            'tipo_refaccion' => 'nullable|max:80',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'cant_existente' => 'required|integer',
            'status' => 'required|integer',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $refaccion = Refacciones::findOrFail($id);
        $refaccion->update($request->except('fotos'));

        if ($request->hasFile('fotos')) {
            // Si hay una foto anterior, la eliminamos
            if ($refaccion->foto) {
                Storage::delete('public/refacciones/' . $refaccion->foto);
            }

            $foto = $request->file('fotos')[0];
            $nombreArchivo = time() . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/refacciones', $nombreArchivo);
            
            $refaccion->foto = $nombreArchivo;
            $refaccion->save();
        }

        return redirect()->route('refacciones.index')->with('success', 'Refacción actualizada exitosamente');
    }

    public function destroy($id)
    {
        $refaccion = Refacciones::findOrFail($id);
        $refaccion->status = 0;
        $refaccion->save();

        return redirect()->route('refacciones.index')->with('success', 'Refacción eliminada exitosamente');
    }

    // Métodos para la tienda con Ajax
    public function obtenerRefacciones(Request $request)
    {
        try {
            $query = Refacciones::where('status', 1);

            if ($request->has('busqueda')) {
                $busqueda = $request->busqueda;
                $query->where(function($q) use ($busqueda) {
                    $q->where('nombre', 'like', "%{$busqueda}%")
                      ->orWhere('marca', 'like', "%{$busqueda}%")
                      ->orWhere('categoria', 'like', "%{$busqueda}%");
                });
            }

            $refacciones = $query->get()->map(function($refaccion) {
                return [
                    'id' => $refaccion->id,
                    'nombre' => $refaccion->nombre,
                    'marca' => $refaccion->marca,
                    'precio' => $refaccion->precio,
                    'stock' => $refaccion->stock,
                    'foto_url' => $refaccion->foto ? asset('storage/refacciones/' . $refaccion->foto) : asset('img/no-image.png')
                ];
            });
            
            \Log::info('Refacciones encontradas: ' . $refacciones->count());
            return response()->json($refacciones);
            
        } catch (\Exception $e) {
            \Log::error('Error en obtenerRefacciones: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener refacciones'], 500);
        }
    }

    public function obtenerDetalleRefaccion($id)
    {
        $refaccion = Refacciones::findOrFail($id);

        return response()->json([
            'refaccion' => [
                'id' => $refaccion->id,
                'nombre' => $refaccion->nombre,
                'marca' => $refaccion->marca,
                'categoria' => $refaccion->categoria,
                'tipo_refaccion' => $refaccion->tipo_refaccion,
                'precio' => $refaccion->precio,
                'stock' => $refaccion->stock,
                'imagen' => $refaccion->foto ? asset('storage/refacciones/' . $refaccion->foto) : null,
                'proveedor' => $refaccion->proveedor ? [
                    'id' => $refaccion->proveedor->id,
                    'nombre' => $refaccion->proveedor->nombre
                ] : null
            ]
        ]);
    }
}