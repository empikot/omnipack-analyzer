<?php
namespace Tests\Domain\Report\Services;

use App\Domain\Report\Services\ReportDataSumCalculator;
use App\Infrastructure\Models\Waybill;
use Illuminate\Support\Collection;

final class ReportDataSumCalculatorTest extends \TestCase
{
    /**
     * @test
     */
    public function calculatingSumForInvalidCollection()
    {
        $collection = new Collection();
        $collection->add(1);
        $collection->add(2);

        $calculator = new ReportDataSumCalculator();

        $this->expectException(\TypeError::class);
        $calculator->calculateSum($collection);
    }

    /**
     * @test
     */
    public function calculatingSumForCollectionOfWaybills()
    {
        $collection = new Collection();
        $collection->add(new Waybill('a', 'b', 1.0, 'd', 'e'));
        $collection->add(new Waybill('a', 'b', 2.0, 'd', 'e'));

        $calculator = new ReportDataSumCalculator();
        $sum = $calculator->calculateSum($collection);

        $this->assertEquals(3.0, $sum);
    }
}
