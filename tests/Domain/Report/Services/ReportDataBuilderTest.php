<?php
namespace Tests\Domain\Report\Services;

use App\Domain\Report\Services\ReportDataBuilder;
use Illuminate\Support\Collection;

final class ReportDataBuilderTest extends \TestCase
{
    /**
     * @test
     */
    public function creatingReportData()
    {
        $builder = new ReportDataBuilder();
        $reportData = $builder->addClientName('test')
            ->addWaybills(new Collection())
            ->addDate(new \DateTime('2019-10-01 12:00:00'))
            ->addSum(100.23)
            ->build();

        $this->assertEquals('test', $reportData->getClientName());
        $this->assertEquals(100.23, $reportData->getSum());
        $this->assertEquals(
            0,
            (int) (new \DateTime('2019-10-01 12:00:00'))->diff($reportData->getDate())->format('%f')
        );
    }
}
