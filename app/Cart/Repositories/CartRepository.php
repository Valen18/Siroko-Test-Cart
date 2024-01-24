<?php

namespace App\Cart\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function addToCart($cartId, $productId, $quantity)
    {
        return Cart::create([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
    }

    public function removeFromCart($cartId, $productId)
    {
        Cart::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->delete();
    }

    public function updateCart($cartId, $productId, $quantity)
    {
        Cart::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->update(['quantity' => $quantity]);
    }

    public function getCart($cartId)
    {
        return Cart::where('cart_id', $cartId)->get();
    }

    public function clearCart($cartId)
    {
        Cart::where('cart_id', $cartId)->delete();
    }
}

