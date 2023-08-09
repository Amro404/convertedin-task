<?php


namespace App\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;

interface TaskRepositoryInterface
{
    public function create(array $attributes): bool;
    public function getTasks(int $perPage = 10): LengthAwarePaginator;
    public function getUsersTasksCount(): Builder;
}
