<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function findOneBy(array $data);
}