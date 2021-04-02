<?php

namespace App\Repositories;
use App\Models\Product;


class ProductRepository
{
 
    protected $product;

    public function __constuct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll()
    {
        return $this->product->get();
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function show($id)
    {
        return $this->product->find($id);
    }

    public function save()
    {
        $product = new $this->product;
        $product->name = $data['name'];
        $product->reference = $data['reference'];
        $product->price = $data['price'];
        $product->delivery_days = $data['delivery_days'];
        $product->save();
        return $product->fresh();
    }
    
    public function update(array $data, $id)
    {
        $record = $this->product->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->product->destroy($id);
    }
}
