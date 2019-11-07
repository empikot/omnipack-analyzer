<?php
namespace App\Domain\Report\Services;

use App\Infrastructure\Models\Waybill;
use Illuminate\Support\Collection;

final class ReportDataSumCalculator implements ElementsSumCalculator
{
    public function calculateSum(Collection $elements): float
    {
        $sum = 0;
        $elements->each(function (Waybill $waybill) use (&$sum) {
            $sum = bcadd((string)$sum, (string)$waybill->getAmount(), 2);
        });
        return $sum;
    }
}
