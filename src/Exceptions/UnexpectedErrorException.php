<?php


namespace Opeepl\BackendTest\Exceptions;

use Exception;

class UnexpectedErrorException extends Exception
{
    public function __construct()
    {
        $message = "Unexpected Error Occurred";
        parent::__construct($message);
    }
}