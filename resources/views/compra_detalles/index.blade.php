@extends('template.master')

@section('contenido')
<div id="wrapper">
  <div id="main">
    <article class="post">
      <header>
        <div class="title">
          <h2>Detalles de Compra</h2>
          <ul class="actions">
            <li><a href="{{ route('compra_detalles.create') }}" class="btn btn-primary btn-lg">Nuevo Detalle</a></li>
          </ul>
        </div>
      </header>
      <section>
        <div class="table-wrapper">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Compra</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registros as $detalle)
                <tr>
                  <td>{{ $detalle->id }}</td>
                  <td>{{ $detalle->id_compra }}</td>
                  <td>{{ $detalle->id_producto }}</td>
                  <td>{{ $detalle->cantidad }}</td>
                  <td>{{ $detalle->precio_individual }}</td>
                  <td>{{ $detalle->subtotal }}</td>
                  <td>
                    <a href="{{ route('compra_detalles.show', $detalle->id) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('compra_detalles.edit', $detalle->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('compra_detalles.destroy', $detalle->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este Detalle?')">Eliminar</button>
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