<?php


namespace App\Http\Controllers\Admin\Tasks\Statistics;

use App\Http\Controllers\Controller;
use App\Services\StatisticServiceInterface;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    private StatisticServiceInterface $statisticService;

    public function __construct(StatisticServiceInterface $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    public function __invoke()
    {
        $users = $this->statisticService->getTopUsersTasksCount();
        return view('admin.tasks.statistics.index', compact('users'));
    }
}
