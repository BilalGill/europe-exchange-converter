<?php


namespace Opeepl\BackendTest\Exceptions;

use Exception;

class InvalidInputException extends Exception
{
    public function __construct()
    {
        $message = "Input is less then zero or null or not integer";
        parent::__construct($message);
    }
}