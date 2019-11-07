<?php
namespace App\Domain\Report\Services;

use App\Domain\Report\ValueObjects\ReportData;
use Illuminate\Support\Collection;

class ReportDataBuilder
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

    public function __construct()
    {
        $this->waybills = new Collection();
    }

    public function addClientName(string $clientName): self
    {
        $this->clientName = $clientName;
        return $this;
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function addDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function addWaybills(Collection $waybills): self
    {
        $this->waybills = $waybills;
        return $this;
    }

    public function getWaybills(): Collection
    {
        return $this->waybills;
    }

    public function addSum(float $sum): self
    {
        $this->sum = $sum;
        return $this;
    }

    public function getSum(): float
    {
        return $this->sum;
    }

    public function build(): ReportData
    {
        return new ReportData($this);
    }
}
