<?php


namespace App\Services;


use Illuminate\Support\Collection;

interface StatisticServiceInterface
{
    public function updateOrInsert(int $userId, int $tasksCount): bool;
    public function getTopUsersTasksCount(): Collection;
}
