<?php


namespace App\Repositories;


use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskRepositoryInterface
{
    private string $table = 'tasks';

    public function create(array $attributes): bool
    {
        return DB::table($this->table)->insert(
            array_merge($attributes, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ])
        );
    }

    public function getTasks(int $perPage = 10): LengthAwarePaginator
    {
        return DB::table($this->table)
            ->select([
                'tasks.title',
                'tasks.description',
                'users.name AS userName',
                'admins.name AS adminName'
            ])
            ->join('users', 'users.id', 'tasks.assigned_to_id')
            ->join('users AS admins', 'admins.id', 'tasks.assigned_by_id')
            ->orderBy('tasks.id', 'DESC')
            ->paginate($perPage);
    }

    public function getUsersTasksCount(): Builder
    {
        return DB::table($this->table)
            ->select([
                'id',
                'assigned_to_id AS user_id',
                DB::raw('COUNT(tasks.id) AS tasks_count')
            ])
            ->groupBy('user_id')
            ->orderBy('id');
    }

}
