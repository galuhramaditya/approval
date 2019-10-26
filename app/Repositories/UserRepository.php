<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function findOneBy(array $data)
    {
        return User::select(DB::raw("cocd, usercd, name, convert(varchar,DECRYPTBYPASSPHRASE('OMEGA',password)) as password"))->where($data)->first();
    }
}
