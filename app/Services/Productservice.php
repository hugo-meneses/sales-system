<?php

namespace App\Services;
use App\Models\Product;
use App\Repositories\ProductRepository;

class Productservice
{

    protected $productRepository;

    public function __constuct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function show($id)
    {
        return $this->productRepository->find($id);
    }

    public function save()
    {
        $result = $this->productRepository->save();
        return $result;
    }

    public function update(array $data, $id)
    {
        $record = $this->productRepository->update($data, $id);
        return $record;
    }

    public function delete($id)
    {
        return $this->productRepository->destroy($id);
    }
}
