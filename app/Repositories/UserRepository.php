<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function findOneBy(array $data)
    {
        return User::select("cocd", "usercd", "name")->where($data)->first();
    }
}