<?php
namespace App\Domain\Report\Services;

use App\Domain\Report\DTOs\ReportDataSet;
use App\Domain\Report\ValueObjects\ReportData;
use App\Infrastructure\Repositories\WaybillRepositoryInterface;

final class ReportDataSetGenerator
{
    /**
     * @var WaybillRepositoryInterface
     */
    private $waybillRepository;
    /**
     * @var ElementsSumCalculator
     */
    private $sumCalculator;

    public function __construct(
        WaybillRepositoryInterface $waybillRepository,
        ElementsSumCalculator $sumCalculator
    ) {
        $this->waybillRepository = $waybillRepository;
        $this->sumCalculator = $sumCalculator;
    }

    public function generate(): ReportDataSet
    {
        $dataSet = new ReportDataSet();
        $clientNames = $this->waybillRepository->findDistinctClientNames();
        foreach ($clientNames as $clientName) {
            $dataSet->addReportData($this->getReportDataForSingleClient($clientName));
        }
        return $dataSet;
    }

    private function getReportDataForSingleClient(string $clientName): ReportData
    {
        $clientWaybills = $this->waybillRepository->findByClientName($clientName);

        return (new ReportDataBuilder())
            ->addClientName($clientName)
            ->addDate(new \DateTime('now'))
            ->addWaybills($clientWaybills)
            ->addSum($this->sumCalculator->calculateSum($clientWaybills))
            ->build();
    }
}
