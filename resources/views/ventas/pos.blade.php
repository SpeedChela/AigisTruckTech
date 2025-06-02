@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Panel Izquierdo - Productos -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">Productos Disponibles</h4>
                        </div>
                        <div class="col">
                            <input type="text" id="buscar-producto" class="form-control" placeholder="Buscar producto...">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" id="productos-grid">
                        <!-- Los productos se cargarán aquí dinámicamente -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Derecho - Carrito -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Carrito de Venta</h4>
                </div>
                <div class="card-body">
                    <!-- Selección de Cliente -->
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select class="form-select" id="cliente-select">
                            <option value="">Seleccionar Cliente...</option>
                        </select>
                    </div>

                    <!-- Lista de Productos en Carrito -->
                    <div class="table-responsive mb-3">
                        <table class="table table-sm" id="carrito-tabla">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cant.</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Items del carrito aquí -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Resumen de Totales -->
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span id="subtotal">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>IVA (16%):</span>
                                <span id="iva">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total:</span>
                                <span id="total">$0.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" id="procesar-venta">
                            <i class="fas fa-cash-register"></i> Procesar Venta
                        </button>
                        <button class="btn btn-danger" id="cancelar-venta">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template para Producto Card -->
<template id="producto-template">
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <img src="" class="card-img-top producto-imagen" alt="Producto">
            <div class="card-body">
                <h5 class="card-title producto-nombre">Nombre del Producto</h5>
                <p class="card-text">
                    <small class="text-muted">Stock: <span class="producto-stock">0</span></small><br>
                    <strong class="producto-precio">$0.00</strong>
                </p>
                <div class="d-flex gap-2">
                    <input type="number" class="form-control form-control-sm cantidad-input" value="1" min="1">
                    <button class="btn btn-primary btn-sm agregar-btn">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

@endsection

@push('styles')
<style>
.producto-imagen {
    height: 150px;
    object-fit: cover;
}
.card-title {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}
.cantidad-input {
    width: 70px;
}
#carrito-tabla {
    font-size: 0.9rem;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Configuración global de AJAX para incluir el token CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let carrito = [];
    
    // Cargar productos iniciales
    cargarProductos();
    cargarClientes();

    // Búsqueda en tiempo real
    $('#buscar-producto').on('input', function() {
        const busqueda = $(this).val().toLowerCase();
        cargarProductos(busqueda);
    });

    // Función para cargar productos
    function cargarProductos(busqueda = '') {
        console.log('Intentando cargar productos...');
        console.log('URL:', '{{ route("api.refacciones") }}');
        
        $.ajax({
            url: '{{ route("api.refacciones") }}',
            method: 'GET',
            data: { busqueda: busqueda },
            success: function(productos) {
                console.log('Productos recibidos:', productos);
                const grid = $('#productos-grid');
                grid.empty();

                if (productos.length === 0) {
                    console.log('No hay productos disponibles');
                    grid.html('<div class="col-12 text-center"><p>No hay productos disponibles</p></div>');
                    return;
                }

                productos.forEach(function(producto) {
                    console.log('Procesando producto:', producto);
                    const template = document.querySelector('#producto-template');
                    const clone = document.importNode(template.content, true);
                    
                    // Llenar datos del producto
                    $(clone).find('.producto-nombre').text(producto.nombre);
                    $(clone).find('.producto-stock').text(producto.stock);
                    $(clone).find('.producto-precio').text('$' + producto.precio);
                    $(clone).find('.card').data('producto', producto);
                    
                    // Usar la URL de la foto proporcionada por el servidor
                    $(clone).find('.producto-imagen').attr('src', producto.foto_url);

                    // Agregar al grid
                    grid.append(clone);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar productos:', error);
                console.log('Estado de la petición:', status);
                console.log('Respuesta del servidor:', xhr.responseText);
                console.log('Código de estado:', xhr.status);
                const grid = $('#productos-grid');
                grid.html('<div class="col-12 text-center"><p>Error al cargar los productos</p></div>');
            }
        });
    }

    // Función para cargar clientes
    function cargarClientes() {
        console.log('Intentando cargar clientes...');
        console.log('URL:', '{{ route("api.clientes") }}');
        
        $.ajax({
            url: '{{ route("api.clientes") }}',
            method: 'GET',
            success: function(clientes) {
                console.log('Clientes recibidos:', clientes);
                const select = $('#cliente-select');
                select.empty().append('<option value="">Seleccionar Cliente...</option>');

                if (clientes.length === 0) {
                    console.log('No hay clientes disponibles');
                    select.append('<option disabled>No hay clientes disponibles</option>');
                    return;
                }

                clientes.forEach(function(cliente) {
                    console.log('Procesando cliente:', cliente);
                    select.append(new Option(cliente.nombre, cliente.id));
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar clientes:', error);
                console.log('Estado de la petición:', status);
                console.log('Respuesta del servidor:', xhr.responseText);
                console.log('Código de estado:', xhr.status);
                const select = $('#cliente-select');
                select.empty().append('<option value="">Error al cargar clientes</option>');
            }
        });
    }

    // Agregar al carrito
    $(document).on('click', '.agregar-btn', function() {
        const card = $(this).closest('.card');
        const producto = card.data('producto');
        const cantidad = parseInt(card.find('.cantidad-input').val());
        
        if (cantidad > producto.stock) {
            alert('No hay suficiente stock disponible');
            return;
        }

        // Buscar si ya existe en el carrito
        const index = carrito.findIndex(item => item.id === producto.id);
        if (index > -1) {
            carrito[index].cantidad += cantidad;
        } else {
            carrito.push({
                id: producto.id,
                nombre: producto.nombre,
                precio: producto.precio,
                cantidad: cantidad
            });
        }

        actualizarCarrito();
    });

    // Eliminar del carrito
    $(document).on('click', '.eliminar-btn', function() {
        const index = $(this).closest('tr').index();
        carrito.splice(index, 1);
        actualizarCarrito();
    });

    // Actualizar carrito
    function actualizarCarrito() {
        const tbody = $('#carrito-tabla tbody');
        tbody.empty();

        let subtotal = 0;

        carrito.forEach(function(item) {
            const total = item.precio * item.cantidad;
            subtotal += total;

            tbody.append(`
                <tr>
                    <td>${item.nombre}</td>
                    <td>${item.cantidad}</td>
                    <td>$${item.precio}</td>
                    <td>$${total.toFixed(2)}</td>
                    <td>
                        <button class="btn btn-danger btn-sm eliminar-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
        });

        const iva = subtotal * 0.16;
        const total = subtotal + iva;

        $('#subtotal').text('$' + subtotal.toFixed(2));
        $('#iva').text('$' + iva.toFixed(2));
        $('#total').text('$' + total.toFixed(2));
    }

    // Procesar venta
    $('#procesar-venta').click(function() {
        if (carrito.length === 0) {
            alert('El carrito está vacío');
            return;
        }

        const cliente_id = $('#cliente-select').val();
        if (!cliente_id) {
            alert('Por favor seleccione un cliente');
            return;
        }

        // Mostrar indicador de carga
        const btnProcesar = $(this);
        const btnTextoOriginal = btnProcesar.html();
        btnProcesar.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Procesando...');

        $.ajax({
            url: '{{ route("ventas.store") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                cliente_id: cliente_id,
                productos: carrito
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    carrito = [];
                    actualizarCarrito();
                    cargarProductos();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                console.error('Error en la venta:', xhr);
                let mensaje = 'Error al procesar la venta';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    mensaje = xhr.responseJSON.message;
                }
                alert(mensaje);
            },
            complete: function() {
                // Restaurar botón
                btnProcesar.prop('disabled', false).html(btnTextoOriginal);
            }
        });
    });

    // Cancelar venta
    $('#cancelar-venta').click(function() {
        if (confirm('¿Está seguro de cancelar la venta?')) {
            carrito = [];
            actualizarCarrito();
        }
    });
});
</script>
@endpush 