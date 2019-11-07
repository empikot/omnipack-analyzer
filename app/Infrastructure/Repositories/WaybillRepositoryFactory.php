<?php
namespace App\Infrastructure\Repositories;

use Illuminate\Support\Collection;

class WaybillRepositoryFactory
{
    public function createWaybillRepository(Collection $dataSource): WaybillRepositoryInterface
    {
        return new WaybillRepository($dataSource);
    }
}
