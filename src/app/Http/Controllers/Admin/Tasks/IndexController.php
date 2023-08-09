<?php


namespace App\Http\Controllers\Admin\Tasks;


use App\Services\TaskServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;


class IndexController extends Controller
{
    private TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function __invoke(): View
    {
        $tasks = $this->taskService->getTasks();
        return view('admin.tasks.index', compact('tasks'));
    }

}
