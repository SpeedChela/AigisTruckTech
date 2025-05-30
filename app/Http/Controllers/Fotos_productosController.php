<?php
use Illuminate\Support\Facades\Storage;
use App\Models\Fotos_productos;
use App\Models\Productos;



class Fotos_productosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fotos_productos = Fotos_productos::where('status', 1)
                  ->orderBy('producto_id')->get();
        return view('Fotos_productos.index')->with('fotos_productos', $fotos_productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Productos::select('id','nombre')
                  ->orderBy('nombre')->get();
        return view('Fotos_productos.create')
                ->with('productos',$productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos   = $request->all();
        $hora    = date ("h:i:s");
        $fecha   = date ("d-m-Y");
        $prefijo = $fecha."_".$hora;

        $archivo = $request->file('foto');

        $nombre_foto = $prefijo."_".$archivo->getClientOriginalName();
        //$nombre_foto = $archivo->hashName(); // Podemos generar un nombre aleatorio

        $r1   = Storage::disk('fotografias')->put($nombre_foto,  \File::get($archivo) );

        if($r1){
            $datos['ruta'] = $nombre_foto;
            Fotos_productos::create($datos);
            return redirect('/fotos_productos');
        }else{
            return 'Error al intentar guardar la foto <br /><br /><a href="../fotos_productos" >REGRESAR A LAS FOTOS PRODUCTOS</a>';
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fotos_producto = Fotos_productos::find($id);
        return view('Fotos_productos.read')->with('fotos_producto', $fotos_producto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fotos_producto = Fotos_productos::find($id);
        $productos = Productos::select('id','nombre')
                  ->orderBy('nombre')->get();
        return view('Fotos_productos.edit')
               ->with('fotos_producto', $fotos_producto)
               ->with('productos',$productos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos = $request->all();
        $fotos_producto = Fotos_productos::find($id);

        $hora    = date ("h:i:s");
        $fecha   = date ("d-m-Y");
        $prefijo = $fecha."_".$hora;

        $archivo = $request->file('foto');

        $nombre_foto = $prefijo."_".$archivo->getClientOriginalName();
        //$nombre_foto = $archivo->hashName(); // Podemos generar un nombre aleatorio

        $r1   = Storage::disk('fotografias')->put($nombre_foto,  \File::get($archivo) );

        if($r1){
            $datos['ruta'] = $nombre_foto;
            $fotos_producto->update($datos);
            return redirect('/fotos_productos');
        }else{
            return 'Error al intentar guardar la foto <br /><br /><a href="../fotos_productos" >REGRESAR A LAS FOTOS PRODUCTOS</a>';
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fotos_producto = Fotos_productos::find($id);
        $fotos_producto->status = 0;
        $fotos_producto->save();
        return redirect('/fotos_productos');
    }
}
