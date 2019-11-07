<?php
namespace App\Domain\Report\Services;

use App\Infrastructure\Repositories\WaybillRepositoryFactory;
use Illuminate\Support\Collection;

class ReportDataSetGeneratorFactory
{
    /**
     * @var WaybillRepositoryFactory
     */
    private $waybillRepositoryFactory;
    /**
     * @var ElementsSumCalculator
     */
    private $sumCalculator;

    public function __construct(WaybillRepositoryFactory $waybillRepositoryFactory, ElementsSumCalculator $sumCalculator)
    {
        $this->waybillRepositoryFactory = $waybillRepositoryFactory;
        $this->sumCalculator = $sumCalculator;
    }

    public function createReportDataSetGenerator(Collection $dataSource): ReportDataSetGenerator
    {
        return new ReportDataSetGenerator(
            $this->waybillRepositoryFactory->createWaybillRepository($dataSource),
            $this->sumCalculator
        );
    }
}
