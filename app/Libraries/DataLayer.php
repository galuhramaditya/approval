<?php

namespace App\Libraries;

class DataLayer
{
    public static function passingData(array $allowed, array $data)
    {
        return array_intersect_key($data, array_flip($allowed));
    }
}