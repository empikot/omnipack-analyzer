<?php
namespace App\Infrastructure\Repositories;

use App\Infrastructure\Models\Waybill;
use Illuminate\Support\Collection;

final class WaybillRepository implements WaybillRepositoryInterface
{
    /**
     * @var Collection
     */
    private $dataSource;

    public function __construct(Collection $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    public function findDistinctClientNames(): array
    {
        $clientNames = [];
        $this->dataSource->each(function (Waybill $waybill) use (&$clientNames) {
            if (!in_array($waybill->getClientName(), $clientNames)) {
                $clientNames[] = $waybill->getClientName();
            }
        });
        return $clientNames;
    }

    public function findAll(): Collection
    {
        $this->dataSource;
    }

    public function findByClientName(string $clientName): Collection
    {
        return $this->dataSource->filter(function (Waybill $waybill) use ($clientName) {
            return $waybill->getClientName() === $clientName;
        });
    }
}
