<?php

namespace App\Cart\Entities;

class Cart
{
    public $id;
    public $products; // Array de Product

    public function __construct($id)
    {
        $this->id = $id;
        $this->products = [];
    }

    public function addProduct($product)
    {
        $this->products[$product->id] = $product;
    }

    public function removeProduct($productId)
    {
        unset($this->products[$productId]);
    }

    public function updateProductQuantity($productId, $quantity)
    {
        if (isset($this->products[$productId])) {
            $this->products[$productId]->quantity = $quantity;
        }
    }
}
