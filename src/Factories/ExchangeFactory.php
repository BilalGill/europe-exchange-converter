<?php


namespace Opeepl\BackendTest\Factories;


use Opeepl\BackendTest\Exceptions\UnsupportedExchangeException;
use Opeepl\BackendTest\Exchanges\AnotherExchange;
use Opeepl\BackendTest\Exchanges\EuropeExchange;
use Opeepl\BackendTest\Exchanges\IExchange;

class ExchangeFactory
{
    /** Factory that returns the exchanges object
     *
     * Another exchange is just used for elaboration
     * 
     * @param string $exchangeName
     * @return IExchange
     * @throws UnsupportedExchangeException
     */
    public function getExchange(string $exchangeName) : IExchange{

        switch ($exchangeName){
            case "EuropeExchange":
                return new EuropeExchange();
            case "AnotherExchange":
                return new AnotherExchange();
            default:
                throw new UnsupportedExchangeException();
        }
    }
}