<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Fotos_productos;
use App\Models\Refacciones;

class FotosProductosController extends Controller
{
    // Formatos de imagen soportados
    protected $formatos_soportados = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    public function index()
    {
        $fotos_productos = Fotos_productos::where('status', 1)
                  ->orderBy('producto_id')->get();
        return view('fotos_productos.index')->with('fotos_productos', $fotos_productos);
    }

    public function create()
    {
        $productos = Refacciones::select('id','nombre')
                  ->orderBy('nombre')->get();
        return view('fotos_productos.create')
                ->with('productos', $productos)
                ->with('formatos_soportados', $this->formatos_soportados);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'producto_id' => 'required|exists:refacciones,id',
            'foto' => 'required|image|mimes:' . implode(',', $this->formatos_soportados) . '|max:2048'
        ], [
            'foto.image' => 'El archivo debe ser una imagen.',
            'foto.mimes' => 'El formato de imagen debe ser: ' . implode(', ', $this->formatos_soportados),
            'foto.max' => 'La imagen no debe pesar más de 2MB.'
        ]);

        $datos = $request->all();
        $hora = date("h:i:s");
        $fecha = date("d-m-Y");
        $prefijo = $fecha."_".$hora;

        if($request->hasFile('foto')) {
            $archivo = $request->file('foto');
            $nombre_foto = $prefijo."_".$archivo->getClientOriginalName();
            
            try {
                $archivo->storeAs('fotografias', $nombre_foto, 'public');
                $datos['ruta'] = $nombre_foto;
                Fotos_productos::create($datos);
                return redirect('/fotos_productos')->with('success', 'Foto guardada exitosamente');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error al guardar la foto: ' . $e->getMessage());
            }
        }
        
        return redirect()->back()->with('error', 'No se recibió ninguna foto');
    }

    public function show(string $id)
    {
        $fotos_producto = Fotos_productos::find($id);
        return view('fotos_productos.show')
               ->with('fotos_producto', $fotos_producto)
               ->with('formatos_soportados', $this->formatos_soportados);
    }

    public function edit(string $id)
    {
        $fotos_producto = Fotos_productos::find($id);
        $productos = Refacciones::select('id','nombre')
                  ->orderBy('nombre')->get();
        return view('fotos_productos.edit')
               ->with('fotos_producto', $fotos_producto)
               ->with('productos', $productos)
               ->with('formatos_soportados', $this->formatos_soportados);
    }

    public function update(Request $request, string $id)
    {
        // Validar la solicitud
        $request->validate([
            'producto_id' => 'required|exists:refacciones,id',
            'foto' => 'nullable|image|mimes:' . implode(',', $this->formatos_soportados) . '|max:2048'
        ], [
            'foto.image' => 'El archivo debe ser una imagen.',
            'foto.mimes' => 'El formato de imagen debe ser: ' . implode(', ', $this->formatos_soportados),
            'foto.max' => 'La imagen no debe pesar más de 2MB.'
        ]);

        $datos = $request->all();
        $fotos_producto = Fotos_productos::find($id);

        if($request->hasFile('foto')) {
            $hora = date("h:i:s");
            $fecha = date("d-m-Y");
            $prefijo = $fecha."_".$hora;

            $archivo = $request->file('foto');
            $nombre_foto = $prefijo."_".$archivo->getClientOriginalName();
            
            try {
                // Eliminar la foto anterior
                Storage::disk('public')->delete('fotografias/' . $fotos_producto->ruta);
                
                // Guardar la nueva foto
                $archivo->storeAs('fotografias', $nombre_foto, 'public');
                $datos['ruta'] = $nombre_foto;
                $fotos_producto->update($datos);
                return redirect('/fotos_productos')->with('success', 'Foto actualizada exitosamente');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error al actualizar la foto: ' . $e->getMessage());
            }
        }
        
        $fotos_producto->update($datos);
        return redirect('/fotos_productos')->with('success', 'Información actualizada exitosamente');
    }

    public function destroy(string $id)
    {
        $fotos_producto = Fotos_productos::find($id);
        
        // Eliminar el archivo físico
        Storage::disk('fotografias')->delete($fotos_producto->ruta);
        
        $fotos_producto->status = 0;
        $fotos_producto->save();
        
        return redirect('/fotos_productos')->with('success', 'Foto eliminada exitosamente');
    }
} 