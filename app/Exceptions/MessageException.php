<?php

namespace App\Exceptions;

use Exception;
use App\Libraries\Response;

class MessageException extends Exception
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return Response::error($this->message);
    }
}