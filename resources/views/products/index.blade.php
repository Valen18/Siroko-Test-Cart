@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <div class="border rounded-lg p-4">
                        <img src="{{ $product->imagen }}" alt="{{ $product->nombre }}" class="w-full h-32 object-cover rounded-md">
                        <h2 class="text-lg font-bold mt-2">{{ $product->nombre }}</h2>
                        <p class="text-gray-700">{{ $product->precio }}€</p>
                        <div class="mt-3 flex items-center"> <!-- Agregamos un div y la clase 'flex' para alinear elementos horizontalmente -->
                            <span class="mr-2">Cantidad:</span> <!-- Texto "Cantidad" -->
                            <input type="number" min="1" value="1" class="quantity-input border p-2 w-full">
                        </div>
                        <button class="add-to-cart-btn mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full" data-product-id="{{ $product->id }}">
                            Añadir al Carrito
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="mt-4 flex justify-center">
    {{ $products->links('vendor.pagination.tailwind') }} <!-- Agrega los enlaces de paginación -->
</div>
@endsection


