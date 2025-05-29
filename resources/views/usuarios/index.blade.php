@extends('template.master')

@section('contenido')
<div id="wrapper">
  <div id="main">
    <article class="post">
      <header>
        <div class="title">
          <h2>Listado de Usuarios</h2>
          <ul class="actions">
            <li><a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-lg">Nuevo Usuario</a></li>
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
                <th>Email</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Status</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registros as $usuario)
                <tr>
                  <td>{{ $usuario->id }}</td>
                  <td>{{ $usuario->nombre }}</td>
                  <td>{{ $usuario->email }}</td>
                  <td>{{ $usuario->telefono }}</td>
                  <td>{{ $usuario->rol }}</td>
                  <td>{{ $usuario->status }}</td>
                  <td>
                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este Usuario?')">Eliminar</button>
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