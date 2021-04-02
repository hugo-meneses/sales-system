<?php

namespace App\Repositories;
use App\Models\Sale;

class SaleRepository
{
    protected $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function getAll()
    {
        return $this->sale->get();
    }

    public function create(array $data)
    {
        return $this->sale->create($data);
    }

    public function show($id)
    {
        return $this->sale->find($id);
    }

    public function save()
    {
        $sale = new $this->sale;
        $sale->purchase_at = $data['purchase_at'];
        $sale->amount = $data['amount'];
        $sale->delivery_days = $data['delivery_days'];
        $sale->save();
        return $sale->fresh();
    }
    
    public function update(array $data, $id)
    {
        $record = $this->sale->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->sale->destroy($id);
    }

  
}
