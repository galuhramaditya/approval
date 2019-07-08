<?php

namespace App\Exceptions;

use Exception;
use App\Libraries\Response;

class ValidationException extends Exception
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return Response::error("request is not complete", $this->data);
    }
}