<?php
namespace App\IO\Services;

use App\Infrastructure\Models\Waybill;
use Illuminate\Support\Collection;

abstract class AbstractReportDataParser
{
    public function parseData(array $rawDataSet): Collection
    {
        $parsedData = new Collection();
        foreach ($rawDataSet as $key => $singleRow) {
            if ($this->checkIfFirstRow($key, $singleRow) || $this->checkIfRowIsEmpty($singleRow)) {
                continue;
            }
            $parsedData->push($this->parseSingleRow($singleRow));
        }
        return $parsedData;
    }

    abstract protected function checkIfFirstRow(int $key, array $singleRow): bool;

    abstract protected function checkIfRowIsEmpty(array $singleRow): bool;

    abstract protected function parseSingleRow(array $singleRow): Waybill;
}
