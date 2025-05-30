@extends('template.master')

@section('contenido')
<div id="wrapper">
  <div id="main">
    <article class="post">
      <header>
        <div class="title">
          <h2>Listado de Proveedores</h2>
          <ul class="actions">
            <li><a href="{{ route('proveedores.create') }}" class="btn btn-primary btn-lg">Nuevo Proveedor</a></li>
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
              @foreach($registros as $proveedor)
                <tr>
                  <td>{{ $proveedor->id }}</td>
                  <td>{{ $proveedor->nombre }}</td>
                  <td>
                    <input type="text"
                          value="{{ $proveedor->telefono }}"
                          class="form-control form-control-sm"
                          onblur="actualizarTelefono({{ $proveedor->id }}, this.value)">
                  </td>
                  <td>{{ $proveedor->email }}</td>
                  <td>{{ $proveedor->municipio_id }}</td>
                  <td>{{ $proveedor->status }}</td>
                  <td>
                    <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-info btn-sm">Detalle</a>
                    <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este Proveedor?')">Eliminar</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function actualizarTelefono(id, telefono) {
    $.ajax({
        url: '/proveedores/' + id + '/actualizar-telefono',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            telefono: telefono
        },
        success: function(response) {
            // Opcional: muestra un mensaje o cambia el color de la celda
            // alert('Teléfono actualizado');
        },
        error: function(xhr) {
            alert('Error al actualizar el teléfono');
        }
    });
}
</script>
@endsection