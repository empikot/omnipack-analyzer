<?php
namespace App\Domain\Report\DTOs;

use App\Domain\Report\ValueObjects\ReportData;
use Illuminate\Support\Collection;

class ReportDataSet
{
    /**
     * @var Collection
     */
    private $reports;

    public function __construct()
    {
        $this->reports = new Collection();
    }

    public function addReportData(ReportData $reportData)
    {
        $this->reports->add($reportData);
    }

    public function getReportData(): Collection
    {
        return $this->reports;
    }
}
