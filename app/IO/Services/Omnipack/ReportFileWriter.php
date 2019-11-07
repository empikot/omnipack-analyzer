<?php
namespace App\IO\Services\Omnipack;

use App\Domain\Report\ValueObjects\ReportData;
use App\Infrastructure\Models\Waybill;
use App\IO\Services\ReportFileWriterInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportFileWriter implements ReportFileWriterInterface
{
    private const REPORT_HEADERS = ['Kurier', 'Nr listu', 'Kwota', 'Klient', 'Nr Zam'];
    private const REPORT_SUM_LABEL = 'Suma:';
    public const REPORT_STORAGE_PATH = 'storage/reports/';

    public function createReportFile(ReportData $reportData)
    {
        $writer = IOFactory::createWriter($this->prepareSpreadsheet($reportData), "Xlsx");
        $writer->save($this->getFileName($reportData));
    }

    private function prepareSpreadsheet(ReportData $reportData): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $this->prepareReportHeaders($worksheet);
        $this->writeReportDataIntoWorksheet($worksheet, $reportData);
        $this->setColumnsDimension($worksheet);

        return $spreadsheet;
    }

    private function prepareReportHeaders(Worksheet $worksheet)
    {
        foreach (self::REPORT_HEADERS as $key => $value) {
            $worksheet->setCellValueByColumnAndRow(++$key, 1, $value);
        }
    }

    private function writeReportDataIntoWorksheet(Worksheet $worksheet, ReportData $reportData)
    {
        // writing data starts from second row, first one is for report headers
        $row = 2;

        foreach ($reportData->getWaybills() as $waybill) {
            $this->writeSingleWaybillIntoWorksheet($worksheet, $waybill, $row);
            $row++;
        }

        // add one empty row
        $row++;
        $this->writeReportDataSumIntoWorksheet($worksheet, $reportData->getSum(), $row);
    }

    private function writeSingleWaybillIntoWorksheet(Worksheet $worksheet, Waybill $waybill, int $currentRow)
    {
        $worksheet->setCellValueByColumnAndRow(1, $currentRow, $waybill->getSpeditor());
        $worksheet->setCellValueByColumnAndRow(2, $currentRow, $waybill->getWaybillNumber());
        $worksheet->setCellValueByColumnAndRow(3, $currentRow, $waybill->getAmount());
        $worksheet->setCellValueByColumnAndRow(4, $currentRow, $waybill->getClientName());
        $worksheet->setCellValueByColumnAndRow(5, $currentRow, $waybill->getOrderNumber());
    }

    private function writeReportDataSumIntoWorksheet(Worksheet $worksheet, float $sum, int $currentRow)
    {
        $worksheet->setCellValueByColumnAndRow(2, $currentRow, self::REPORT_SUM_LABEL);
        $worksheet->setCellValueByColumnAndRow(3, $currentRow, $sum);
    }

    private function setColumnsDimension(Worksheet $worksheet)
    {
        $worksheet->getColumnDimension('A')->setAutoSize(true);
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);
        $worksheet->getColumnDimension('D')->setAutoSize(true);
        $worksheet->getColumnDimension('E')->setAutoSize(true);
    }

    /**
     * @todo maybe should be extracted to separate service?
     * @param ReportData $reportData
     * @return string
     */
    private function getFileName(ReportData $reportData): string
    {
        return self::REPORT_STORAGE_PATH . $reportData->getClientName() . '_report_' . $reportData->getDate()->format('Ymd') . '.xlsx';
    }
}
