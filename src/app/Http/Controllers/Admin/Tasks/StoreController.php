<?php


namespace App\Http\Controllers\Admin\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Services\TaskServiceInterface;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    private TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function __invoke(TaskStoreRequest $request): RedirectResponse
    {
        $this->taskService->createTask($request->validated());
        return redirect('/admin/users/tasks');
    }
}
