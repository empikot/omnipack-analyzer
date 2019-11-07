<?php
namespace App\IO\Services\Omnipack;

use App\Infrastructure\Models\Waybill;
use App\IO\Services\AbstractReportDataParser;

final class ReportDataParser extends AbstractReportDataParser
{
    protected function checkIfFirstRow(int $key, array $singleRow): bool
    {
        return 0 === $key;
    }

    protected function checkIfRowIsEmpty(array $singleRow): bool
    {
        return null === $singleRow[0];
    }

    protected function parseSingleRow(array $singleRow): Waybill
    {
        return new Waybill(
            $singleRow[0],
            $singleRow[1],
            $singleRow[2],
            $singleRow[3],
            $singleRow[4]
        );
    }
}
