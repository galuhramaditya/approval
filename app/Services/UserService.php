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
        if (array_key_exists("password", $data)) {
            $password = $data["password"];
            unset($data["password"]);
        }

        $find = $this->userRepository->findOneBy($data);

        if (isset($password) && $find->password != $password) {
            return null;
        }

        unset($find->password);
        return $find;
    }
}
