@extends('layouts.app')

@section('styles')
<style>
    .refaccion-card {
        transition: transform 0.3s ease;
        height: 100%;
    }
    .refaccion-card:hover {
        transform: translateY(-5px);
    }
    .refaccion-image {
        height: 200px;
        object-fit: cover;
    }
    .filter-btn.active {
        background-color: #4a5568;
        color: white;
    }
    #cart-count {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #e53e3e;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Barra de búsqueda y filtros -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-4 items-center justify-between">
            <div class="flex-1 max-w-md">
                <input type="text" id="search" placeholder="Buscar refacciones..." 
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex gap-2">
                <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 active" data-categoria="">Todas</button>
                <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100" data-categoria="Motor">Motor</button>
                <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100" data-categoria="Carrocería">Carrocería</button>
                <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100" data-categoria="Frenos">Frenos</button>
                <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100" data-categoria="Eléctrico">Eléctrico</button>
            </div>
            <div class="relative">
                <button id="cart-btn" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-count">0</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Grid de refacciones -->
    <div id="refacciones-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- Las refacciones se cargarán aquí dinámicamente -->
    </div>

    <!-- Modal de detalle de refacción -->
    <div id="refaccion-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4">
            <div class="flex justify-between items-start mb-4">
                <h2 id="modal-titulo" class="text-2xl font-bold"></h2>
                <button class="text-gray-500 hover:text-gray-700" onclick="cerrarModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="modal-contenido">
                <!-- El contenido del modal se cargará dinámicamente -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let carrito = [];

function cargarRefacciones(categoria = '', busqueda = '') {
    fetch(`/api/refacciones?categoria=${categoria}&busqueda=${busqueda}`)
        .then(response => response.json())
        .then(data => {
            const grid = document.getElementById('refacciones-grid');
            grid.innerHTML = '';

            data.refacciones.forEach(refaccion => {
                const card = document.createElement('div');
                card.className = 'refaccion-card bg-white rounded-lg shadow-md overflow-hidden';
                card.innerHTML = `
                    <img src="${refaccion.imagen || '/img/no-image.jpg'}" alt="${refaccion.nombre}" 
                         class="refaccion-image w-full">
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold">${refaccion.nombre}</h3>
                            <span class="px-2 py-1 bg-gray-200 text-sm rounded">${refaccion.marca}</span>
                        </div>
                        <p class="text-gray-600 mb-2">${refaccion.categoria} - ${refaccion.tipo_refaccion}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold">$${refaccion.precio}</span>
                            <button onclick="verDetalle(${refaccion.id})" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Ver más
                            </button>
                        </div>
                    </div>
                `;
                grid.appendChild(card);
            });
        });
}

function verDetalle(id) {
    fetch(`/api/refacciones/${id}`)
        .then(response => response.json())
        .then(data => {
            const refaccion = data.refaccion;
            document.getElementById('modal-titulo').textContent = refaccion.nombre;
            
            let contenido = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <img src="${refaccion.imagen || '/img/no-image.jpg'}" 
                             alt="${refaccion.nombre}" 
                             class="w-full h-64 object-cover rounded-lg">
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Marca:</span>
                            <span class="font-semibold">${refaccion.marca}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Categoría:</span>
                            <span class="font-semibold">${refaccion.categoria}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Tipo:</span>
                            <span class="font-semibold">${refaccion.tipo_refaccion}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold">$${refaccion.precio}</span>
                            <span class="text-gray-600">Stock: ${refaccion.stock}</span>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <label class="text-gray-600">Cantidad:</label>
                                <input type="number" min="1" max="${refaccion.stock}" value="1" 
                                       id="cantidad" class="w-20 px-2 py-1 border rounded">
                            </div>
                            <button onclick="agregarAlCarrito(${refaccion.id})" 
                                    class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('modal-contenido').innerHTML = contenido;
            document.getElementById('refaccion-modal').classList.remove('hidden');
        });
}

function cerrarModal() {
    document.getElementById('refaccion-modal').classList.add('hidden');
}

function agregarAlCarrito(refaccionId) {
    const cantidad = parseInt(document.getElementById('cantidad').value);
    const itemExistente = carrito.find(item => item.id === refaccionId);
    
    if (itemExistente) {
        itemExistente.cantidad += cantidad;
    } else {
        carrito.push({ id: refaccionId, cantidad });
    }
    
    actualizarContadorCarrito();
    cerrarModal();
    
    // Mostrar notificación
    Swal.fire({
        title: '¡Refacción agregada!',
        text: 'La refacción se agregó al carrito exitosamente',
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    });
}

function actualizarContadorCarrito() {
    const total = carrito.reduce((sum, item) => sum + item.cantidad, 0);
    document.getElementById('cart-count').textContent = total;
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    cargarRefacciones();

    // Búsqueda
    let timeoutId;
    document.getElementById('search').addEventListener('input', (e) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            const categoria = document.querySelector('.filter-btn.active').dataset.categoria;
            cargarRefacciones(categoria, e.target.value);
        }, 300);
    });

    // Filtros de categoría
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const busqueda = document.getElementById('search').value;
            cargarRefacciones(btn.dataset.categoria, busqueda);
        });
    });

    // Cerrar modal al hacer clic fuera
    document.getElementById('refaccion-modal').addEventListener('click', (e) => {
        if (e.target === e.currentTarget) {
            cerrarModal();
        }
    });
});
</script>
@endsection 