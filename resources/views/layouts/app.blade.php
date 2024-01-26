<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Siroko Test Cart</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <header class="bg-black">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="/" class="text-white text-lg font-bold">Siroko Test Cart</a>
                    </div>
                </div>
                <div class="relative inline-block text-left" id="cart-menu">
                    <button type="button" class="flex items-center text-white" id="cart-button">
                        <i id="cart-icon" class="fas fa-shopping-cart cart-animate mr-2"></i> Carrito
                        <span id="cart-count" class="ml-2">{{ count(session('cart', [])) }}</span>
                    </button>
                    
                    <div id="cart-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">  
                        <!-- Contenedor dedicado para los productos del carrito-->
                        <div class="product-container">  
                            @forelse(session('cart', []) as $id => $details)
                                <div class="px-4 py-2 flex items-center" role="menuitem">
                                    <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="h-10 w-10 object-cover mr-2"> <!-- Imagen del producto -->
                                    <div class="flex-grow">
                                        <span class="block text-sm">{{ $details['name'] }}</span>
                                        <span class="block text-sm text-gray-500">Cantidad: {{ $details['quantity'] }}</span>
                                        <span class="block text-sm text-gray-500">Total: {{ $details['quantity'] * $details['price'] }}€</span>
                                    </div>
                                    <button class="remove-from-cart" data-product-id="{{ $id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            @empty
                                <div class="px-4 py-2">
                                    <span class="block text-sm">Aun no hay productos en el carrito</span>
                                </div>
                            @endforelse
                        </div>
                        <!-- Total del carrito -->
                        <div class="px-4 py-2">
                            <strong>Total: </strong><span id="cart-total">0€</span>
                        </div>
                        <!-- Botón de completar la compra -->
                        <div class="px-2 py-2">
                            <a href="/checkout" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded w-full text-center">Completar la compra</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
    <script>
        // Asignar los datos del carrito a una variable global
        window.cartData = @json(session('cart', []));
    </script>
    @vite('resources/js/app.js')    
</body>
</html>
