<?php


namespace App\Providers;

use App\Repositories\StatisticRepository;
use App\Repositories\StatisticRepositoryInterface;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\StatisticService;
use App\Services\StatisticServiceInterface;
use App\Services\TaskService;
use App\Services\TaskServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
       $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
       $this->app->bind(TaskServiceInterface::class, TaskService::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(StatisticRepositoryInterface::class, StatisticRepository::class);
        $this->app->bind(StatisticServiceInterface::class, StatisticService::class);
    }

}
