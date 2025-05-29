@extends('template.master')

@section('contenido')
<div id="wrapper">
  <div id="main">
    <article class="post">
      <header>
        <div class="title">
          <h2>Estados de Envío</h2>
          <ul class="actions">
            <li><a href="{{ route('estado_envios.create') }}" class="btn btn-primary btn-lg">Nuevo Estado</a></li>
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
                <th>Status</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registros as $estado)
                <tr>
                  <td>{{ $estado->id }}</td>
                  <td>{{ $estado->id_compra }}</td>
                  <td>{{ $estado->status }}</td>
                  <td>
                    <a href="{{ route('estado_envios.show', $estado->id) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('estado_envios.edit', $estado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('estado_envios.destroy', $estado->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este Estado?')">Eliminar</button>
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