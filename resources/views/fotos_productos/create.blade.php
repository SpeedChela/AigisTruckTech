@extends('template.master')
@section('contenido')
  <div class="jumbotron">
    <h1>Crear Foto de Producto</h1>
  </div>

  <div class="ourstory">
    <div class="container">
      <div class="col-md-10 col-md-offset-1">


<form method="POST" action="{!! asset('fotos_productos') !!}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <br />
    <br />
    <label id="producto_id" >Producto</label>
    <select name="producto_id" id="producto_id" placeholder="Selecionar...">
    <option value="0" >Seleccionar...</option>
        @foreach($productos as $producto)
            <option value="{!! $producto->id !!}" >{!! $producto->nombre !!}</option>
        @endforeach
    </select>

    <input type="hidden" name="ruta" value="fotografia" />

    <br />
    <br />
    <label id="foto" >FOTO</label>
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
    <input type="submit" name="" value="Guardar Foto del Producto">
</form>

   </div>
    </div>
    </div>
  <br /><br />

@endsection()
