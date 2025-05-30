@extends('template.master')

@section('contenido')
<script src="{{ asset('estilo/js/jquery.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Función para cargar usuarios
    function cargarUsuarios(params = {}) {
        $.ajax({
            url: "{{ route('usuarios.index') }}",
            type: "GET",
            data: params,
            dataType: "json",
            success: function(response) {
                var tbody = '';
                response.data.forEach(function(usuario) {
                    tbody += `
                        <tr>
                            <td>${usuario.id}</td>
                            <td>${usuario.nombre}</td>
                            <td>${usuario.email}</td>
                            <td>${usuario.telefono}</td>
                            <td>${usuario.rol}</td>
                            <td>${usuario.status}</td>
                            <td>
                                <a href="/usuarios/${usuario.id}" class="btn btn-info btn-sm">Detalle</a>
                                <a href="/usuarios/${usuario.id}/edit" class="btn btn-warning btn-sm">Editar</a>
                                <button onclick="eliminarUsuario(${usuario.id})" class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $("#usuarios-tbody").html(tbody);
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar usuarios:', error);
                alert('Error al cargar los usuarios. Por favor, intente nuevamente.');
            }
        });
    }

    // Manejar cambios en los filtros
    $("#filtro-form input, #filtro-form select").on('change keyup', function() {
        var params = {
            nombre: $("#nombre").val(),
            email: $("#email").val(),
            rol: $("#rol").val(),
            status: $("#status").val()
        };
        cargarUsuarios(params);
    });

    // Eliminar usuario
    window.eliminarUsuario = function(id) {
        if (confirm('¿Eliminar este Usuario?')) {
            $.ajax({
                url: `/usuarios/${id}`,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    cargarUsuarios();
                },
                error: function(xhr, status, error) {
                    console.error('Error al eliminar usuario:', error);
                    alert('Error al eliminar el usuario. Por favor, intente nuevamente.');
                }
            });
        }
    }

    // Cargar usuarios inicialmente
    cargarUsuarios();
});
</script>

<form id="filtro-form" class="mb-3">
  <div class="row">
    <div class="col">
      <input type="text" id="nombre" class="form-control" placeholder="Nombre">
    </div>
    <div class="col">
      <input type="text" id="email" class="form-control" placeholder="Email">
    </div>
    <div class="col">
      <select id="rol" class="form-control">
        <option value="">Rol</option>
        <option value="1">Admin</option>
        <option value="2">Vendedor</option>
        <option value="3">Cliente</option>
      </select>
    </div>
    <div class="col">
      <select id="status" class="form-control">
        <option value="">Estatus</option>
        <option value="1">Activo</option>
        <option value="0">Baja</option>
      </select>
    </div>
    <div class="col">
      <button type="button" onclick="$('#filtro-form')[0].reset(); cargarUsuarios()" class="btn btn-secondary">Limpiar</button>
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
            <tbody id="usuarios-tbody">
              <!-- Los datos se cargarán aquí mediante AJAX -->
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