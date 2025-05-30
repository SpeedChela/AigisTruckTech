@extends('template.master')
@section('contenido')
  <div class="jumbotron">
    <h1>Detalle de la Foto de Producto</h1>
  </div>

  <div class="ourstory">
    <div class="container">
      <div class="col-md-10 col-md-offset-1">

<h2>Producto: {!! $fotos_producto->productos->nombre !!}</h2>
<h2>Foto del producto:</h2>
<img src="../../storage/fotografias/{!! $fotos_producto->ruta !!}" height="150px" />
<br /><br />
<a href="{!! asset('fotos_productos') !!}" class="btn btn-primary btn-lg">REGRESAR FOTOS DE PRODUCTOS</a>


   </div>
    </div>
    </div>
  <br /><br />

@endsection()