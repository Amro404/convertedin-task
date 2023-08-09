<?php

namespace App\Jobs;

use App\Services\StatisticServiceInterface;
use App\Services\TaskServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateTaskCountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct()
    {

    }

    public function handle(
        StatisticServiceInterface $statisticService,
        TaskServiceInterface $taskService
    )
    {
        $data = $taskService->getUsersTasksCount();
        $data->chunk(1000, function ($tasks) use ($statisticService) {
            foreach ($tasks as $task) {
                $statisticService->updateOrInsert($task->user_id, $task->tasks_count);
            }
        });
    }
}
