<?php


namespace App\Services;


use App\Repositories\StatisticRepositoryInterface;
use Illuminate\Support\Collection;

class StatisticService implements StatisticServiceInterface
{
    private StatisticRepositoryInterface $statisticRepository;

    public function __construct(StatisticRepositoryInterface $statisticRepository)
    {
        $this->statisticRepository = $statisticRepository;
    }

    public function updateOrInsert(int $userId, int $tasksCount): bool
    {
        return $this->statisticRepository->updateOrInsert($userId, $tasksCount);
    }

    public function getTopUsersTasksCount(): Collection
    {
        return $this->statisticRepository->getTopUsersTasksCount();
    }

}
