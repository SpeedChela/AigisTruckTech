@extends('layouts.app')

@section('styles')
<style>
    .product-card {
        transition: transform 0.3s ease;
        height: 100%;
    }
    .product-card:hover {
        transform: translateY(-5px);
    }
    .product-image {
        height: 200px;
        object-fit: cover;
    }
    .category-btn.active {
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
                <input type="text" id="search" placeholder="Buscar productos..." 
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex gap-2">
                <button class="category-btn px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 active" data-category="">Todos</button>
                <button class="category-btn px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100" data-category="repuestos">Repuestos</button>
                <button class="category-btn px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100" data-category="accesorios">Accesorios</button>
                <button class="category-btn px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100" data-category="herramientas">Herramientas</button>
                <button class="category-btn px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100" data-category="otros">Otros</button>
            </div>
            <div class="relative">
                <button id="cart-btn" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-count">0</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Grid de productos -->
    <div id="productos-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- Los productos se cargarán aquí dinámicamente -->
    </div>

    <!-- Modal de detalle de producto -->
    <div id="producto-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
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

function cargarProductos(categoria = '', busqueda = '') {
    fetch(`/api/productos?categoria=${categoria}&busqueda=${busqueda}`)
        .then(response => response.json())
        .then(data => {
            const grid = document.getElementById('productos-grid');
            grid.innerHTML = '';

            data.productos.forEach(producto => {
                const card = document.createElement('div');
                card.className = 'product-card bg-white rounded-lg shadow-md overflow-hidden';
                card.innerHTML = `
                    <img src="${producto.imagen || '/img/no-image.jpg'}" alt="${producto.nombre}" 
                         class="product-image w-full">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">${producto.nombre}</h3>
                        <p class="text-gray-600 mb-4">${producto.descripcion.substring(0, 100)}...</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold">$${producto.precio}</span>
                            <button onclick="verDetalle(${producto.id})" 
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
    fetch(`/api/productos/${id}`)
        .then(response => response.json())
        .then(data => {
            const producto = data.producto;
            document.getElementById('modal-titulo').textContent = producto.nombre;
            
            let contenido = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="aspect-w-1 aspect-h-1">
                            <img src="${producto.fotos[0]?.ruta || '/img/no-image.jpg'}" 
                                 alt="${producto.nombre}" 
                                 class="w-full h-full object-cover rounded-lg">
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            ${producto.fotos.slice(1).map(foto => `
                                <img src="${foto.ruta}" 
                                     alt="Foto producto" 
                                     class="w-full h-20 object-cover rounded cursor-pointer"
                                     onclick="cambiarFotoPrincipal(this.src)">
                            `).join('')}
                        </div>
                    </div>
                    <div class="space-y-4">
                        <p class="text-gray-600">${producto.descripcion}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold">$${producto.precio}</span>
                            <span class="text-gray-600">Stock: ${producto.stock}</span>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <label class="text-gray-600">Cantidad:</label>
                                <input type="number" min="1" max="${producto.stock}" value="1" 
                                       id="cantidad" class="w-20 px-2 py-1 border rounded">
                            </div>
                            <button onclick="agregarAlCarrito(${producto.id})" 
                                    class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('modal-contenido').innerHTML = contenido;
            document.getElementById('producto-modal').classList.remove('hidden');
        });
}

function cerrarModal() {
    document.getElementById('producto-modal').classList.add('hidden');
}

function cambiarFotoPrincipal(src) {
    document.querySelector('#modal-contenido .aspect-w-1 img').src = src;
}

function agregarAlCarrito(productoId) {
    const cantidad = parseInt(document.getElementById('cantidad').value);
    const itemExistente = carrito.find(item => item.id === productoId);
    
    if (itemExistente) {
        itemExistente.cantidad += cantidad;
    } else {
        carrito.push({ id: productoId, cantidad });
    }
    
    actualizarContadorCarrito();
    cerrarModal();
    
    // Mostrar notificación
    Swal.fire({
        title: '¡Producto agregado!',
        text: 'El producto se agregó al carrito exitosamente',
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
    cargarProductos();

    // Búsqueda
    let timeoutId;
    document.getElementById('search').addEventListener('input', (e) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            const categoria = document.querySelector('.category-btn.active').dataset.category;
            cargarProductos(categoria, e.target.value);
        }, 300);
    });

    // Filtros de categoría
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const busqueda = document.getElementById('search').value;
            cargarProductos(btn.dataset.category, busqueda);
        });
    });

    // Cerrar modal al hacer clic fuera
    document.getElementById('producto-modal').addEventListener('click', (e) => {
        if (e.target === e.currentTarget) {
            cerrarModal();
        }
    });
});
</script>
@endsection 