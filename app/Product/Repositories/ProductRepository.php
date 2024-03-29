<?php

namespace App\Product\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function create($data)
    {
        return Product::create($data);
    }

    public function update($id, $data)
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
        }
        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }
    }

    public function findById($id)
    {
        return Product::find($id);
    }

    public function getAll()
    {
        return Product::all();
    }
}

