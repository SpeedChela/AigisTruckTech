@extends('template.master')
@section('contenido')
  <div class="jumbotron">
    <h1>Listado de Fotos de Productos</h1>
  </div>

  <div class="ourstory">
    <div class="container">
      <div class="col-md-10 col-md-offset-1">

  <a href="{!! asset('fotos_productos/create') !!}" class="btn btn-primary btn-lg" >Crear una nueva Foto de Producto</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Ruta</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
        @foreach($fotos_productos as $fotos_producto)
        <tr>
            <td>{!! $fotos_producto->id !!}</td>
            <td>{!! $fotos_producto->productos->nombre !!} </td>
            <td><img src="../storage/fotografias/{!! $fotos_producto->ruta !!}" height="150px" /> </td>
            <td>{!! $fotos_producto->ruta !!} </td>


            <td>
                <a href="{!! 'fotos_productos/'.$fotos_producto->id !!}">Detalle</a>
           <a href="{!! 'fotos_productos/'.$fotos_producto->id.'/edit' !!}">Editar</a>

                <form method="POST" action="{!! asset('fotos_productos/'.$fotos_producto->id) !!}">
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="submit" name="" value="Eliminar">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <br />
    <a href="{!! asset('cruds') !!}" class="btn btn-primary btn-lg">REGRESAR A LOS CRUDS</a>




    </div>
    </div>
    </div>
  <br /><br />

@endsection()
