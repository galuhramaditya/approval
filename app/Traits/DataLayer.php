<?php

namespace App\Traits;

use Firebase\JWT\JWT;

trait DataLayer
{
    public function passingData(array $allowed, array $data)
    {
        return array_intersect_key($data, array_flip($allowed));
    }
}