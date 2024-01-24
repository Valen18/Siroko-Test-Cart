<?php

namespace App\Cart\Services;

use App\Cart\Repositories\CartRepository;
use App\Product\Repositories\ProductRepository; // Asegúrate de incluir el repositorio de productos.

class CartService
{
    protected $cartRepository;
    protected $productRepository;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function addToCart($data)
    {
        // Verificar la existencia del producto y la cantidad disponible.
        $product = $this->productRepository->findById($data['product_id']);
        if (!$product || $data['quantity'] <= 0) {
            return null; // O manejar con una excepción o mensaje de error.
        }

        // Añadir el producto al carrito.
        return $this->cartRepository->addToCart($data['cart_id'], $data['product_id'], $data['quantity']);
    }

    public function removeFromCart($cartId, $productId)
    {
        // Eliminar un producto del carrito.
        return $this->cartRepository->removeFromCart($cartId, $productId);
    }

    public function updateCartItem($cartId, $productId, $quantity)
    {
        // Verificar la nueva cantidad.
        if ($quantity <= 0) {
            // Si la cantidad es 0 o negativa, eliminar el producto del carrito.
            return $this->removeFromCart($cartId, $productId);
        }

        // Actualizar la cantidad de un producto en el carrito.
        return $this->cartRepository->updateCart($cartId, $productId, $quantity);
    }

    public function getCartContents($cartId)
    {
        // Obtener los contenidos actuales del carrito.
        $cartItems = $this->cartRepository->getCart($cartId);

        // Aquí podrías agregar lógica adicional para sumar precios, cantidades, etc.
        return $cartItems;
    }

    public function clearCart($cartId)
    {
        // Vaciar todo el carrito.
        $this->cartRepository->clearCart($cartId);
    }
}
