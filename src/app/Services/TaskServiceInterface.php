<?php


namespace App\Services;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;

interface TaskServiceInterface
{
    public function createTask(array $attributes): void;
    public function getTasks(int $parPage = 1): LengthAwarePaginator;
    public function getUsersTasksCount(): Builder;
}
