<?php
namespace App\Domain\Report\ValueObjects;

use App\Domain\Report\Services\ReportDataBuilder;
use Illuminate\Support\Collection;

class ReportData
{
    /**
     * @var string
     */
    private $clientName;
    /**
     * @var \DateTime
     */
    private $date;
    /**
     * @var Collection
     */
    private $waybills;
    /**
     * @var float
     */
    private $sum;

    public function __construct(ReportDataBuilder $reportDataBuilder)
    {
        $this->clientName = $reportDataBuilder->getClientName();
        $this->date = $reportDataBuilder->getDate();
        $this->waybills = $reportDataBuilder->getWaybills();
        $this->sum = $reportDataBuilder->getSum();
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function getWaybills(): Collection
    {
        return $this->waybills;
    }

    public function getSum(): float
    {
        return $this->sum;
    }
}
