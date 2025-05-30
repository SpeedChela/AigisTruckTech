@extends('template.master')

@section('contenido')
<div id="wrapper">
  <div id="main">
    <article class="post">
      <header>
        <div class="title">
          <h2>Listado de Compras</h2>
          <ul class="actions">
            <li><a href="{{ route('compras.create') }}" class="btn btn-primary btn-lg">Nueva Compra</a></li>
          </ul>
        </div>
      </header>
      <section>
        <div class="table-wrapper">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Proveedor</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Status</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registros as $compra)
                <tr>
                  <td>{{ $compra->id }}</td>
                  <td>{{ $compra->id_proveedor }}</td>
                  <td>{{ $compra->id_usuario }}</td>
                  <td>{{ $compra->fecha_compra }}</td>
                  <td>{{ $compra->total }}</td>
                  <td>{{ $compra->status }}</td>
                  <td>
                    <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta Compra?')">Eliminar</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <ul class="actions">
            <li><a href="{{ url('/') }}" class="btn btn-secondary btn-lg">Regresar</a></li>
          </ul>
        </div>
      </section>
    </article>
  </div>
</div>
@endsection