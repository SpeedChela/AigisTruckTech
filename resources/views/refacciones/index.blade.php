@extends('template.master')

@section('contenido')
<div id="wrapper">
  <div id="main">
    <article class="post">
      <header>
        <div class="title">
          <h2>Listado de Refacciones</h2>
          <ul class="actions">
            <li><a href="{{ route('refacciones.create') }}" class="btn btn-primary btn-lg">Nueva Refacción</a></li>
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
                <th>Nombre</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($refacciones as $refaccion)
                <tr>
                  <td>{{ $refaccion->id }}</td>
                  <td>{{ $refaccion->proveedor->nombre }}</td>
                  <td>{{ $refaccion->nombre }}</td>
                  <td>{{ $refaccion->marca }}</td>
                  <td>{{ $refaccion->precio }}</td>
                  <td>{{ $refaccion->stock }}</td>
                  <td>{{ $refaccion->status }}</td>
                  <td>
                    <a href="{{ route('refacciones.show', $refaccion->id) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('refacciones.edit', $refaccion->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('refacciones.destroy', $refaccion->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta Refacción?')">Eliminar</button>
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