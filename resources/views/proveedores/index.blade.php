@extends('template.master')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
.input-group-text {
  min-width: 40px;
  justify-content: center;
}
.d-none {
  display: none !important;
}
</style>
@endpush

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
                    <div class="input-group">
                      <input type="text"
                            value="{{ $proveedor->telefono }}"
                            class="form-control form-control-sm telefono-input"
                            data-id="{{ $proveedor->id }}"
                            data-original-value="{{ $proveedor->telefono }}"
                            maxlength="20">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="fas fa-check text-success d-none check-icon"></i>
                          <i class="fas fa-times text-danger d-none error-icon"></i>
                          <i class="fas fa-spinner fa-spin d-none loading-icon"></i>
                        </span>
                      </div>
                    </div>
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

@push('scripts')
<script>
$(document).ready(function() {
    // Configurar AJAX para incluir el token CSRF en todas las peticiones
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    let timeoutId;
    
    $('.telefono-input').on('input', function() {
        const $input = $(this);
        const $group = $input.closest('.input-group');
        const $loading = $group.find('.loading-icon');
        const $check = $group.find('.check-icon');
        const $error = $group.find('.error-icon');
        
        // Guardar el valor original para comparar
        const originalValue = $input.data('original-value') || $input.val();
        $input.data('original-value', originalValue);
        
        clearTimeout(timeoutId);
        
        // Solo actualizar si el valor ha cambiado
        if ($input.val() !== originalValue) {
            timeoutId = setTimeout(function() {
                actualizarTelefono($input, $loading, $check, $error);
            }, 500);
        }
    });
    
    function actualizarTelefono($input, $loading, $check, $error) {
        const id = $input.data('id');
        const telefono = $input.val();
        
        // Ocultar todos los iconos y mostrar loading
        $check.addClass('d-none');
        $error.addClass('d-none');
        $loading.removeClass('d-none');
        
        $.ajax({
            url: '{{ url("/") }}/proveedores/' + id + '/actualizar-telefono',
            method: 'POST',
            data: {
                telefono: telefono
            },
            success: function(response) {
                console.log('Respuesta del servidor:', response);
                if (response.success) {
                    $loading.addClass('d-none');
                    $check.removeClass('d-none');
                    
                    // Actualizar el valor original después de un guardado exitoso
                    $input.data('original-value', response.telefono);
                    
                    // Ocultar el check después de 2 segundos
                    setTimeout(function() {
                        $check.addClass('d-none');
                    }, 2000);
                } else {
                    handleError($loading, $error, response.message || 'Error al actualizar');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
                
                let errorMsg;
                try {
                    const response = JSON.parse(xhr.responseText);
                    errorMsg = response.message || 'Error al actualizar el teléfono';
                } catch (e) {
                    errorMsg = 'Error al actualizar el teléfono: ' + error;
                }
                
                handleError($loading, $error, errorMsg);
                
                // Revertir al valor original en caso de error
                $input.val($input.data('original-value'));
            }
        });
    }
    
    function handleError($loading, $error, errorMsg) {
        $loading.addClass('d-none');
        $error.removeClass('d-none');
        
        // Mostrar mensaje de error
        console.error('Error:', errorMsg);
        alert(errorMsg);
        
        // Ocultar el error después de 2 segundos
        setTimeout(function() {
            $error.addClass('d-none');
        }, 2000);
    }
});
</script>
@endpush

@endsection