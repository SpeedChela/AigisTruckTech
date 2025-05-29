@extends('template.master')

@section('contenido')
<div id="wrapper">
  <div id="main">
    <article class="post">
      <header>
        <div class="title">
          <h2>Listado de Empresas</h2>
          <ul class="actions">
            <li><a href="{{ route('empresas.create') }}" class="btn btn-primary btn-lg">Nueva Empresa</a></li>
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
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Status</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registros as $empresa)
                <tr>
                  <td>{{ $empresa->id }}</td>
                  <td>{{ $empresa->id_usuario_up }}</td>
                  <td>{{ $empresa->direccion }}</td>
                  <td>{{ $empresa->telefono }}</td>
                  <td>{{ $empresa->correo }}</td>
                  <td>{{ $empresa->status }}</td>
                  <td>
                    <a href="{{ route('empresas.show', $empresa->id) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta Empresa?')">Eliminar</button>
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