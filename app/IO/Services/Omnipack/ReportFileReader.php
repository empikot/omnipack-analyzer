<?php
namespace App\IO\Services\Omnipack;

use App\IO\Services\ReportFileReaderInterface;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;

final class ReportFileReader implements ReportFileReaderInterface
{
    /**
     * @var ReportDataParser
     */
    private $parser;
    /**
     * @var \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    private $spreadsheet;

    public function __construct(ReportDataParser $parser)
    {
        $this->parser = $parser;
    }

    public function loadData(string $filePath)
    {
        $reader = IOFactory::createReader("Xlsx");
        $this->spreadsheet = $reader->load($filePath);
    }

    public function getParsedData(): Collection
    {
        return $this->parser->parseData($this->spreadsheet->getActiveSheet()->toArray());
    }
}
