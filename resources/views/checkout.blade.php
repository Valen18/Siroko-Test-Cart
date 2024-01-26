@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-4">Resumen del Carrito</h1>
            @if (count(session('cart', [])) > 0)
                <table class="w-full mb-4">
                    <thead>
                        <tr>
                            <th class="text-left">Imagen</th>
                            <th class="text-left">Producto</th>
                            <th class="text-left">Cantidad</th>
                            <th class="text-left">Precio Unitario</th>
                            <th class="text-left">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('cart', []) as $id => $details)
                        
                            <tr data-price="{{ $details['price'] }}"> <!-- Añade data-price con el precio unitario -->
                                <td class="py-2">
                                    <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-16 h-16 object-cover rounded-md">
                                    
                                </td>
                                <td class="py-2">{{ $details['name'] }}</td>
                                <td class="py-2">{{ $details['quantity'] }}</td>
                                <td class="py-2">{{ $details['price'] }}€</td>
                                <td class="py-2">{{ $details['quantity'] * $details['price'] }}€</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right font-bold mt-4">
                    Total: <span id="cartTotal">€</span> <!-- Elemento para mostrar el total -->
                </div>
                <div class="mt-6">
                    <a href="/completar-compra" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Completar Compra y Pagar</a>
                </div>
            @else
                <p class="text-gray-600">Aún no hay productos en el carrito.</p>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('tr[data-price]');
        let total = 0;

        rows.forEach(row => {
            const price = parseFloat(row.getAttribute('data-price'));
            const quantity = parseInt(row.querySelector('td:nth-child(3)').textContent);
            const totalPrice = price * quantity;
            total += totalPrice;
        });

        document.getElementById('cartTotal').textContent = total.toFixed(2) + '€'; // Actualiza el total en el elemento HTML
    });
</script>
@endsection
