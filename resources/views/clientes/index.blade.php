@extends('template.master')

@section('contenido')
<div id="wrapper">
  <div id="main">
    <article class="post">
      <header>
        <div class="title">
          <h2>Listado de Clientes</h2>
          <ul class="actions">
            <li><a href="{{ route('clientes.create') }}" class="btn btn-primary btn-lg">Nuevo Cliente</a></li>
          </ul>
        </div>
      </header>
      <section>
        <div class="table-wrapper">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Municipio</th>
                <th>Status</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registros as $cliente)
                <tr>
                  <td>{{ $cliente->id }}</td>
                  <td>{{ $cliente->nombre }}</td>
                  <td>{{ $cliente->telefono }}</td>
                  <td>{{ $cliente->email }}</td>
                  <td>{{ $cliente->municipio_id }}</td>
                  <td>{{ $cliente->status }}</td>
                  <td>
                    <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este Cliente?')">Eliminar</button>
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