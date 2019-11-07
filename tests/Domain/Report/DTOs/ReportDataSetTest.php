<?php
namespace Tests\Domain\Report\DTOs;

use App\Domain\Report\DTOs\ReportDataSet;
use App\Domain\Report\Services\ReportDataBuilder;
use Illuminate\Support\Collection;

final class ReportDataSetTest extends \TestCase
{
    /**
     * @test
     */
    public function preparingEmptyDataSet()
    {
        $dataSet = new ReportDataSet();
        $this->assertEmpty($dataSet->getReportData()->toArray());
    }

    /**
     * @test
     */
    public function preparingNotEmptyDataSet()
    {
        $dataSet = new ReportDataSet();

        $dataSet->addReportData(
            (new ReportDataBuilder())
                ->addClientName('testA')
                ->addWaybills(new Collection())
                ->addSum(0)
                ->addDate(new \DateTime())
                ->build()
        );
        $this->assertEquals(1, $dataSet->getReportData()->count());

        $dataSet->addReportData(
            (new ReportDataBuilder())
                ->addClientName('testB')
                ->addWaybills(new Collection())
                ->addSum(0)
                ->addDate(new \DateTime())
                ->build()
        );
        $this->assertEquals(2, $dataSet->getReportData()->count());
    }

    /**
     * @test
     */
    public function addingInvalidReportData()
    {
        $this->expectException(\TypeError::class);
        (new ReportDataSet())->addReportData("anything that isn't report data obj");
    }
}
