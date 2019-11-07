<?php
namespace App\Domain\Report\Services;

use App\Domain\Report\ValueObjects\ReportData;
use App\IO\Services\ReportFileReaderInterface;
use App\IO\Services\ReportFileWriterInterface;
use Illuminate\Support\Collection;

final class ReportsGenerator
{
    /**
     * @var ReportFileReaderInterface
     */
    private $reportFileReader;
    /**
     * @var ReportFileWriterInterface
     */
    private $reportFileWriter;
    /**
     * @var ReportDataSetGeneratorFactory
     */
    private $reportDataSetGeneratorFactory;

    public function __construct(
        ReportFileReaderInterface $reportFileReader,
        ReportFileWriterInterface $reportFileWriter,
        ReportDataSetGeneratorFactory $reportDataSetGeneratorFactory
    ) {
        $this->reportFileReader = $reportFileReader;
        $this->reportFileWriter = $reportFileWriter;
        $this->reportDataSetGeneratorFactory = $reportDataSetGeneratorFactory;
    }

    public function generateFromInputFile(string $fileName)
    {
        $sourceData = $this->readInputData($fileName);
        $reportDataSet = $this->reportDataSetGeneratorFactory->createReportDataSetGenerator($sourceData)->generate();
        $reportDataSet->getReportData()->each(function (ReportData $reportData) {
            $this->generateSingleReport($reportData);
        });
    }

    private function readInputData(string $fileName): Collection
    {
        $this->reportFileReader->loadData($fileName);
        return $this->reportFileReader->getParsedData();
    }

    private function generateSingleReport(ReportData $reportData)
    {
        $this->reportFileWriter->createReportFile($reportData);
    }
}
