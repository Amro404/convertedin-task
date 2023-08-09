<?php


namespace App\Repositories;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    private string $table = 'users';

    public function getUsers(): ?Collection
    {
        return DB::table($this->table)
            ->select('id', 'name')
            ->where('is_admin', false)
            ->get();
    }

    public function getAdmins(): ?Collection
    {
        return DB::table($this->table)
            ->select('id', 'name')
            ->where('is_admin', true)
            ->get();
    }
}
