<?php
namespace App\IO\Services;

use App\Domain\Report\ValueObjects\ReportData;

interface ReportFileWriterInterface
{
    public function createReportFile(ReportData $reportData);
}
