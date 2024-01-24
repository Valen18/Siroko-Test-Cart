<?php

namespace App\Product\Entities;

class Product
{
    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $imagen;

    public function __construct($id, $nombre, $descripcion, $precio, $imagen)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }

    public function updateImage($newImage)
    {
        $this->imagen = $newImage;
    }

    public function updateName($newName)
    {
        $this->nombre = $newName;
    }

    public function updatePrice($newPrice)
    {
        $this->precio = $newPrice;
    }

    public function updateDescription($newDescription)
    {
        $this->descripcion = $newDescription;
    }
}
