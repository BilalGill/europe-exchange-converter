<?php


namespace Opeepl\BackendTest\Exceptions;

use Exception;

class UnsupportedCurrencyException extends Exception
{
    const DEFAULT_MESSAGE = "Currency not available";
    public function __construct($message = self::DEFAULT_MESSAGE)
    {
        parent::__construct($message);
    }
}