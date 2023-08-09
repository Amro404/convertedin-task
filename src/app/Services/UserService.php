<?php


namespace App\Services;


use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers(): ?Collection
    {
        return $this->userRepository->getUsers();
    }

    public function getAdmins(): ?Collection
    {
        return $this->userRepository->getAdmins();
    }

}
