@extends('template.master')

@section('contenido')
<div id="wrapper">
  <div id="main">
    <article class="post">
      <header>
        <div class="title">
          <h2>Listado de Municipios</h2>
          <ul class="actions">
            <li><a href="{{ route('municipios.create') }}" class="btn btn-primary btn-lg">Nuevo Municipio</a></li>
          </ul>
        </div>
      </header>
      <section>
        <div class="table-wrapper">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Estado ID</th>
                <th>Nombre</th>
                <th>Status</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registros as $municipio)
                <tr>
                  <td>{{ $municipio->id }}</td>
                  <td>{{ $municipio->estado_id }}</td>
                  <td>{{ $municipio->nombre }}</td>
                  <td>{{ $municipio->status }}</td>
                  <td>
                    <a href="{{ route('municipios.show', $municipio->id) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('municipios.edit', $municipio->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('municipios.destroy', $municipio->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este Municipio?')">Eliminar</button>
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