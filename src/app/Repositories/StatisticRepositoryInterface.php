<?php


namespace App\Repositories;

use Illuminate\Support\Collection;

interface StatisticRepositoryInterface
{
    public function updateOrInsert(int $userId, int $tasksCount): bool;
    public function getTopUsersTasksCount(): Collection;
}
