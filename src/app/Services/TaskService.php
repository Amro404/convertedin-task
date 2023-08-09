<?php


namespace App\Services;


use App\Repositories\TaskRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class TaskService implements TaskServiceInterface
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function createTask($attributes): void
    {
        DB::beginTransaction();
        try {
            $this->taskRepository->create($attributes);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
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
