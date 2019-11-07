<?php
namespace Tests\Domain\Report\Services;

use App\Domain\Report\Services\ElementsSumCalculator;
use App\Domain\Report\Services\ReportDataSetGenerator;
use App\Domain\Report\Services\ReportDataSetGeneratorFactory;
use App\Infrastructure\Repositories\WaybillRepositoryFactory;
use App\Infrastructure\Repositories\WaybillRepositoryInterface;
use Illuminate\Support\Collection;

final class ReportDataSetGeneratorFactoryTest extends \TestCase
{
    /**
     * @test
     */
    public function creatingReportDataSetGenerator()
    {
        $waybillRepository = $this->prophesize(WaybillRepositoryInterface::class)->reveal();
        $waybillRepositoryFactory = $this->prophesize(WaybillRepositoryFactory::class);
        $waybillRepositoryFactory->createWaybillRepository(new Collection())->willReturn($waybillRepository);

        $factory = new ReportDataSetGeneratorFactory(
            $waybillRepositoryFactory->reveal(),
            $this->prophesize(ElementsSumCalculator::class)->reveal()
        );

        $raportDataSetGenerator = $factory->createReportDataSetGenerator(new Collection());
        $this->assertInstanceOf(ReportDataSetGenerator::class, $raportDataSetGenerator);
    }
}
