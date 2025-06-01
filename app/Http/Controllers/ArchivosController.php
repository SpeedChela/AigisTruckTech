<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArchivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archivos = Archivo::where('status', true)->get();
        return response()->json($archivos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'archivo' => 'required|file|max:10240', // máximo 10MB
                'tipo' => 'required|in:imagen,pdf',
                'modelo_tipo' => 'required|string',
                'modelo_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            $archivo = $request->file('archivo');
            $extension = $archivo->getClientOriginalExtension();
            
            // Validar tipo de archivo según el tipo especificado
            if ($request->tipo === 'imagen' && !in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'El archivo debe ser una imagen válida'
                ], 422);
            }
            
            if ($request->tipo === 'pdf' && $extension !== 'pdf') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'El archivo debe ser un PDF'
                ], 422);
            }

            // Generar nombre único para el archivo
            $nombreSistema = Str::uuid() . '.' . $extension;
            
            // Definir la ruta de almacenamiento
            $ruta = 'public/archivos/' . $request->tipo . '/' . $nombreSistema;
            
            // Almacenar el archivo
            Storage::put($ruta, file_get_contents($archivo));

            // Crear registro en la base de datos
            $archivoModel = Archivo::create([
                'nombre_original' => $archivo->getClientOriginalName(),
                'nombre_sistema' => $nombreSistema,
                'ruta' => $ruta,
                'tipo_mime' => $archivo->getMimeType(),
                'tamanio' => $archivo->getSize(),
                'extension' => $extension,
                'tipo' => $request->tipo,
                'archivable_type' => $request->modelo_tipo,
                'archivable_id' => $request->modelo_id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Archivo subido correctamente',
                'data' => $archivoModel
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al subir el archivo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $archivo = Archivo::findOrFail($id);
            
            // Eliminar físicamente el archivo
            $archivo->eliminarArchivo();
            
            // Eliminar registro de la base de datos
            $archivo->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Archivo eliminado correctamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar el archivo',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
