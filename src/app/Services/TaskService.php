<?php


namespace App\Services;


use App\Repositories\TaskRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class TaskService implements TaskServiceInterface
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function createTask(array $attributes): void
    {
        try {
            $this->taskRepository->create($attributes);
        } catch (\Exception $exception) {
            throw $exception;
        }

    }

    public function getTasks(int $perPage = 10): LengthAwarePaginator
    {
        return $this->taskRepository->getTasks($perPage);
    }

    public function getUsersTasksCount(): Builder
    {
        return $this->taskRepository->getUsersTasksCount();
    }
}
