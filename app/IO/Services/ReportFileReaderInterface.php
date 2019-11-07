<?php
namespace App\IO\Services;

use Illuminate\Support\Collection;

interface ReportFileReaderInterface
{
    public function loadData(string $filePath);

    public function getParsedData(): Collection;
}
