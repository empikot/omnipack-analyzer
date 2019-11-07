<?php
namespace App\Infrastructure\Repositories;

use Illuminate\Support\Collection;

interface WaybillRepositoryInterface
{
    public function findDistinctClientNames();

    public function findAll(): Collection;

    public function findByClientName(string $clientName): Collection;
}
