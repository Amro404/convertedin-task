<?php


namespace App\Services;


use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function getUsers(): ?Collection;
    public function getAdmins(): ?Collection;
}
