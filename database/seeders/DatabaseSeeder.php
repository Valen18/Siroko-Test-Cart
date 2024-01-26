<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            Product::create([
                'nombre' => 'Producto ' . $i,
                'descripcion' => 'Descripción del Producto ' . $i,
                'precio' => rand(100, 1000), // Genera un precio aleatorio
                'imagen' => 'https://picsum.photos/300/300?random=' . $i, // Imagen aleatoria de Lorem Picsum
            ]);
        }
    }
    
}
