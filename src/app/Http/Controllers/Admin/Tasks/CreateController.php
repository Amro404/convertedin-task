<?php


namespace App\Http\Controllers\Admin\Tasks;

use App\Http\Controllers\Controller;
use App\Services\UserServiceInterface;
use Illuminate\Contracts\View\View;

class CreateController extends Controller
{

    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(): View
    {
        $users = $this->userService->getUsers();
        $admins = $this->userService->getAdmins();
        return view('admin.tasks.create', compact('users', 'admins'));
    }

}
