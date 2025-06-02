<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\FotoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('fotoPrincipal')->where('status', true)->get();
        return view('productos.index', compact('productos'));
    }

    public function tienda()
    {
        $productos = Producto::with('fotoPrincipal')
            ->where('status', true)
            ->get();
        return view('productos.tienda', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'descripcion' => 'required',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => 'required|in:repuestos,accesorios,herramientas,otros',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $producto = Producto::create($request->except('fotos'));

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $foto) {
                $nombreArchivo = time() . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('public/productos', $nombreArchivo);

                FotoProducto::create([
                    'producto_id' => $producto->id,
                    'ruta' => $nombreArchivo,
                    'es_principal' => $index === 0, // La primera foto será la principal
                    'status' => true
                ]);
            }
        }

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }

    public function edit($id)
    {
        $producto = Producto::with('fotos')->findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'descripcion' => 'required',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => 'required|in:repuestos,accesorios,herramientas,otros',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->except('fotos'));

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $nombreArchivo = time() . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('public/productos', $nombreArchivo);

                FotoProducto::create([
                    'producto_id' => $producto->id,
                    'ruta' => $nombreArchivo,
                    'es_principal' => false,
                    'status' => true
                ]);
            }
        }

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->status = false;
        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente');
    }

    public function eliminarFoto($id)
    {
        $foto = FotoProducto::findOrFail($id);
        Storage::delete('public/productos/' . $foto->ruta);
        $foto->delete();

        return response()->json(['success' => true]);
    }

    public function establecerFotoPrincipal($id)
    {
        $foto = FotoProducto::findOrFail($id);
        
        // Quitar el estado principal de todas las fotos del producto
        FotoProducto::where('producto_id', $foto->producto_id)
            ->update(['es_principal' => false]);
        
        // Establecer la nueva foto principal
        $foto->es_principal = true;
        $foto->save();

        return response()->json(['success' => true]);
    }

    // Métodos para la tienda con Ajax
    public function obtenerProductos(Request $request)
    {
        $query = Producto::with('fotoPrincipal')->where('status', true);

        if ($request->categoria) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->busqueda) {
            $query->where('nombre', 'like', '%' . $request->busqueda . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->busqueda . '%');
        }

        $productos = $query->get();

        return response()->json([
            'productos' => $productos->map(function($producto) {
                return [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'descripcion' => $producto->descripcion,
                    'precio' => $producto->precio,
                    'stock' => $producto->stock,
                    'imagen' => $producto->fotoPrincipal ? asset('storage/productos/' . $producto->fotoPrincipal->ruta) : null
                ];
            })
        ]);
    }

    public function obtenerDetalleProducto($id)
    {
        $producto = Producto::with(['fotos' => function($query) {
            $query->where('status', true);
        }])->findOrFail($id);

        return response()->json([
            'producto' => [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'descripcion' => $producto->descripcion,
                'precio' => $producto->precio,
                'stock' => $producto->stock,
                'categoria' => $producto->categoria,
                'fotos' => $producto->fotos->map(function($foto) {
                    return [
                        'id' => $foto->id,
                        'ruta' => asset('storage/productos/' . $foto->ruta),
                        'es_principal' => $foto->es_principal
                    ];
                })
            ]
        ]);
    }
} 