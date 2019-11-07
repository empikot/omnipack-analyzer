<?php

namespace App\IO\Providers;

use App\Domain\Report\Services\ElementsSumCalculator;
use App\Domain\Report\Services\ReportDataSumCalculator;
use App\IO\Services\Omnipack\ReportFileReader;
use App\IO\Services\Omnipack\ReportFileWriter;
use App\IO\Services\ReportFileReaderInterface;
use App\IO\Services\ReportFileWriterInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        }

        $this->app->singleton(ElementsSumCalculator::class, function() {
            return app(ReportDataSumCalculator::class);
        });
        $this->app->singleton(ReportFileReaderInterface::class, function() {
            return app(ReportFileReader::class);
        });
        $this->app->singleton(ReportFileWriterInterface::class, function() {
            return app(ReportFileWriter::class);
        });
    }
}
