<?php

namespace App\Http\Controllers;

use App\Cart\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
    }

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = $this->service->addToCart($validatedData);

        return response()->json($cartItem, 201);
    }

    public function updateCart(Request $request, $productId)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($this->service->updateCartItem($productId, $validatedData['quantity'])) {
            return response()->json(['message' => 'Carrito actualizado']);
        }

        return response()->json(['message' => 'Producto no encontrado en el carrito'], 404);
    }

    public function removeFromCart($productId)
    {
        if ($this->service->removeFromCart($productId)) {
            return response()->json(['message' => 'Producto eliminado del carrito']);
        }

        return response()->json(['message' => 'Producto no encontrado en el carrito'], 404);
    }

    public function showCart()
    {
        return response()->json($this->service->getCartContents());
    }

    public function clearCart()
    {
        $this->service->clearCart();
        return response()->json(['message' => 'Carrito vaciado']);
    }
}

