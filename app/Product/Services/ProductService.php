<?php

namespace App\Product\Services;

use App\Product\Repositories\ProductRepository;

class ProductService
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllProducts()
    {
        return $this->repository->getAll();
    }

    public function createProduct($data)
    {
        return $this->repository->create($data);
    }

    public function getProductById($id)
    {
        return $this->repository->findById($id);
    }

    public function updateProduct($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->repository->delete($id);
    }
}
