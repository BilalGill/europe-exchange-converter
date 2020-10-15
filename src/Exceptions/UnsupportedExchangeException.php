<?php


namespace Opeepl\BackendTest\Exceptions;

use Exception;

class UnsupportedExchangeException extends Exception
{
    public function __construct()
    {
        $message = "Exchange not available!";
        parent::__construct($message);
    }
}