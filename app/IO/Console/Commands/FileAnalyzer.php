<?php
namespace App\IO\Console\Commands;

use App\Domain\Report\Services\ReportsGenerator;
use App\IO\Services\Omnipack\ReportFileWriter;
use Illuminate\Console\Command;

final class FileAnalyzer extends Command
{
    /**
     * @var string
     */
    protected $signature = 'omnipack:analyze {input_file : path to input file}';

    /**
     * @var string
     */
    protected $description = 'Reads data from input file and creates reports for each client';

    public function handle()
    {
        $this->info('Reading input file...');

        $inputFile = $this->argument('input_file');
        $reportsGenerator = app(ReportsGenerator::class);
        $reportsGenerator->generateFromInputFile($inputFile);

        $this->info('Report files were generated and are stored in ' . ReportFileWriter::REPORT_STORAGE_PATH);
    }
}
