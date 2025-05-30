@extends('template.master')
@section('contenido')
  <div class="jumbotron">
    <h1>Editar Foto de Producto</h1>
  </div>

  <div class="ourstory">
    <div class="container">
      <div class="col-md-10 col-md-offset-1">

<h2>Foto actual del producto:</h2>
<img src="../../../storage/fotografias/{!! $fotos_producto->ruta !!}" height="150px" />

<form method="POST" action="{!! asset('fotos_productos/'.$fotos_producto->id) !!}" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <input type="hidden" name="producto_id" value="{!! $fotos_producto->producto_id !!}" />

    <input type="hidden" name="ruta" value="fotografia" />

    <br />
    <br />
    <label id="foto" >NUEVA FOTO</label>
    <input type="file" name="foto" id="foto" accept="image/*" />


    <br />
    <br />
    <label id="status" >Status de la foto</label>
    <select name="status" id="status" placeholder="Selecionar...">
        <option value="1" >Activo</option>
        <option value="0" >Baja</option>
    </select>
    <br />
    <br />
    <input type="submit" name="" value="Actualizar Foto del Producto">
</form>

   </div>
    </div>
    </div>
  <br /><br />

@endsection()
