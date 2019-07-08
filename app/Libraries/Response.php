<?php

namespace App\Libraries;

class Response
{
    public static function success(string $message, $data = null, int $code = 200)
    {
        $response = (new self)->formatResponse($message, $data);
        return response()->json($response, $code);
    }

    public static function error(string $message, $data = null, int $code = 400)
    {
        $response = (new self)->formatResponse($message, $data);
        return response()->json($response, $code);
    }

    private function formatResponse($message, $data)
    {
        $response["message"] = $message;

        if (!empty($data)) {
            $response["data"] = $data;
        }

        return $response;
    }
}