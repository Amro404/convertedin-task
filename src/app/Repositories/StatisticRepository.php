<?php


namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StatisticRepository implements StatisticRepositoryInterface
{
    private string $table = 'statistics';

    private const TOP_USERS_LIMIT = 10;

    public function updateOrInsert(int $userId, int $tasksCount): bool
    {
        $uniqueBy = ['user_id' => $userId];
        $values = [
            'tasks_count' => $tasksCount,
            'created_at' => now(),
            'updated_at' => now()
        ];
        return DB::table($this->table)->updateOrInsert($uniqueBy, $values);
    }

    public function getTopUsersTasksCount(): Collection
    {
        return DB::table($this->table)
            ->select(
                [
                    'users.name',
                    'statistics.tasks_count'
                ]
            )
            ->join('users', 'users.id', 'statistics.user_id')
            ->orderBy('tasks_count', 'DESC')
            ->limit(self::TOP_USERS_LIMIT)
            ->get();
    }
}
