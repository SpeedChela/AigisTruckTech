@extends('template.master')

@section('contenido')
<div id="wrapper">
  <div id="main">
    <article class="post">
      <header>
        <div class="title">
          <h2>Listado de Ventas</h2>
          <ul class="actions">
            <li><a href="{{ route('ventas.create') }}" class="btn btn-primary btn-lg">Nueva Venta</a></li>
          </ul>
        </div>
      </header>
      <section>
        <div class="table-wrapper">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Status</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registros as $venta)
                <tr>
                  <td>{{ $venta->id }}</td>
                  <td>{{ $venta->id_usuario }}</td>
                  <td>{{ $venta->id_cliente }}</td>
                  <td>{{ $venta->fecha_venta }}</td>
                  <td>{{ $venta->total }}</td>
                  <td>{{ $venta->status }}</td>
                  <td>
                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta Venta?')">Eliminar</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <ul class="actions">
            <li><a href="{{ asset('cruds') }}" class="btn btn-secondary btn-lg">Regresar</a></li>
          </ul>
        </div>
      </section>
    </article>
  </div>
</div>
@endsection