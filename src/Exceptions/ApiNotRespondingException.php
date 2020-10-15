<?php


namespace Opeepl\BackendTest\Exceptions;

use Exception;

class ApiNotRespondingException extends Exception
{
    public function __construct()
    {
        $message = "Requested Api is not responding";
        parent::__construct($message);
    }
}