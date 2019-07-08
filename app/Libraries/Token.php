<?php

namespace App\Libraries;

use Firebase\JWT\JWT;

class Token
{
    public static function encode($token)
    {
        return JWT::encode($token, env("APP_KEY"));
    }

    public static function decode($token)
    {
        return JWT::decode($token, env("APP_KEY"), array('HS256'));
    }
}
