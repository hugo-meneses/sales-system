<?php

namespace App\Services;
use App\Models\Sale;
use App\Repositories\SaleRepository;

class SaleService
{

    protected $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function getAll()
    {
        return $this->saleRepository->getAll();
    }

    public function show($id)
    {
        return $this->saleRepository->find($id);
    }

    public function save()
    {
        $result = $this->saleRepository->save();
        return $result;
    }

    public function update(array $data, $id)
    {
        $record = $this->saleRepository->update($data, $id);
        return $record;
    }

    public function delete($id)
    {
        return $this->saleRepository->destroy($id);
    }
}
