<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Archivo extends Model
{
    use HasFactory;

    protected $table = 'archivos';
    
    protected $fillable = [
        'nombre_original',
        'nombre_sistema',
        'ruta',
        'tipo_mime',
        'tamanio',
        'extension',
        'tipo',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'tamanio' => 'integer'
    ];

    // Relación polimórfica - permite relacionar el archivo con cualquier otro modelo
    public function archivable()
    {
        return $this->morphTo();
    }

    // Obtener la URL completa del archivo
    public function getUrlAttribute()
    {
        return Storage::url($this->ruta);
    }

    // Obtener el tamaño en formato legible
    public function getTamanioLegibleAttribute()
    {
        $bytes = $this->tamanio;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, 2) . ' ' . $units[$pow];
    }

    // Verificar si es una imagen
    public function getEsImagenAttribute()
    {
        return in_array($this->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    }

    // Verificar si es un PDF
    public function getEsPdfAttribute()
    {
        return $this->extension === 'pdf';
    }

    // Eliminar físicamente el archivo
    public function eliminarArchivo()
    {
        if (Storage::exists($this->ruta)) {
            Storage::delete($this->ruta);
        }
    }
}
