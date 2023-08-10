<?php


namespace App\Repositories;


use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getUsers(): ?Collection;
    public function getAdmins(): ?Collection;
}
