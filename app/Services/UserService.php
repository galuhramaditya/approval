<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findOneBy(array $data)
    {
        return $this->userRepository->findOneBy($data);
    }
}