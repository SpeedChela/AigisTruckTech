@extends('template.master')

@section('contenido')
<form method="GET" action="{{ route('usuarios.index') }}" class="mb-3">
  <div class="row">
    <div class="col">
      <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ request('nombre') }}">
    </div>
    <div class="col">
      <input type="text" name="email" class="form-control" placeholder="Email" value="{{ request('email') }}">
    </div>
    <div class="col">
      <select name="rol" class="form-control">
        <option value="">Rol</option>
        <option value="1" @if(request('rol')=='1') selected @endif>Admin</option>
        <option value="2" @if(request('rol')=='2') selected @endif>Vendedor</option>
        <option value="3" @if(request('rol')=='3') selected @endif>Cliente</option>
      </select>
    </div>
    <div class="col">
      <select name="status" class="form-control">
        <option value="">Estatus</option>
        <option value="1" @if(request('status')=='1') selected @endif>Activo</option>
        <option value="0" @if(request('status')=='0') selected @endif>Baja</option>
      </select>
    </div>
    <div class="col">
      <button type="submit" class="btn btn-primary">Buscar</button>
      <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Limpiar</a>
    </div>
  </div>
</form>

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