<?php
namespace App\Domain\Report\Services;

use Illuminate\Support\Collection;

interface ElementsSumCalculator
{
    public function calculateSum(Collection $elements): float;
}
