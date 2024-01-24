<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Product\Entities\Product;

class ProductTest extends TestCase
{
    /** @test */
    public function can_create_product_with_details()
    {
        $product = new Product(1, 'Producto Test', 'Descripción', 100, 'imagen.jpg');
        $this->assertEquals('Producto Test', $product->nombre);
    }
}
