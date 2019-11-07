<?php
namespace Tests\Domain\Report\Services;

use App\Domain\Report\Services\ElementsSumCalculator;
use App\Domain\Report\Services\ReportDataSetGenerator;
use App\Infrastructure\Repositories\WaybillRepositoryInterface;
use Illuminate\Support\Collection;

class ReportDataSetGeneratorTest extends \TestCase
{
    private $waybillRepository;
    private $elementsSumCalculator;

    public function setUp(): void
    {
        parent::setUp();
        $this->waybillRepository = $this->prophesize(WaybillRepositoryInterface::class);

        $this->elementsSumCalculator = $this->prophesize(ElementsSumCalculator::class);
        $this->elementsSumCalculator->calculateSum(new Collection())->willReturn(0);
    }

    /**
     * @test
     */
    public function generatingEmptyDataSet()
    {
        $this->waybillRepository->findDistinctClientNames()->willReturn([]);

        $generator = new ReportDataSetGenerator(
            $this->waybillRepository->reveal(),
            $this->elementsSumCalculator->reveal()
        );
        $reportDataSet = $generator->generate();

        $this->assertEquals(0, $reportDataSet->getReportData()->count());
    }

    /**
     * @test
     */
    public function generatingDataSetContainingOneElement()
    {
        $this->waybillRepository->findDistinctClientNames()->willReturn(['a']);
        $this->waybillRepository->findByClientName('a')->willReturn(new Collection());

        $generator = new ReportDataSetGenerator(
            $this->waybillRepository->reveal(),
            $this->elementsSumCalculator->reveal()
        );
        $reportDataSet = $generator->generate();

        $this->assertEquals(1, $reportDataSet->getReportData()->count());
    }

    /**
     * @test
     */
    public function generatingDataSetContainingMoreThanOneElements()
    {
        $this->waybillRepository->findDistinctClientNames()->willReturn(['a', 'b']);
        $this->waybillRepository->findByClientName('a')->willReturn(new Collection());
        $this->waybillRepository->findByClientName('b')->willReturn(new Collection());

        $generator = new ReportDataSetGenerator(
            $this->waybillRepository->reveal(),
            $this->elementsSumCalculator->reveal()
        );
        $reportDataSet = $generator->generate();

        $this->assertEquals(2, $reportDataSet->getReportData()->count());
    }
}
