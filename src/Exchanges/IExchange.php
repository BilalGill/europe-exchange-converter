<?php


namespace Opeepl\BackendTest\Exchanges;


interface IExchange
{
    /**
     * @return array<string>
     */
    public function getCurrencies() : array;

    /**
     * @param int $amount
     * @param string $fromCurrency
     * @param string $toCurrency
     * @return int
     */
    public function getConvertedAmount(int $amount, string $fromCurrency, string $toCurrency) : int;
}