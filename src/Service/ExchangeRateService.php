<?php
namespace Opeepl\BackendTest\Service;

use Opeepl\BackendTest\DataSource\Http;
use Opeepl\BackendTest\Exceptions\InvalidInputException;
use Opeepl\BackendTest\Exceptions\UnsupportedExchangeException;
use Opeepl\BackendTest\Exchanges\IExchange;
use Opeepl\BackendTest\Factories\ExchangeFactory;

/**
 * Main entrypoint for this library.
 */
class ExchangeRateService {

    /** @var IExchange  */
    private $exchange;

    /** @var array<string> */
    private $currencies;

    /**
     * ExchangeRateService constructor.
     * @throws UnsupportedExchangeException
     */
    public function __construct()
    {
        $exchangeFactory = new ExchangeFactory();

        // We could easily switch between exchanges by just changes parameter here
        $this->exchange = $exchangeFactory->getExchange("EuropeExchange");
    }

    /**
     * @return array<string>
     */
    public function getSupportedCurrencies(): array {

        // We don't need to get supported currencies if we already had one. By doing this we minimize api calls
        if(!isset($this->currencies))
            $this->currencies = $this->exchange->getCurrencies();

        return $this->currencies;
    }

    /**
     * @param int $amount
     * @param string $fromCurrency
     * @param string $toCurrency
     * @return int
     * @throws InvalidInputException
     */
    public function getExchangeAmount(int $amount, string $fromCurrency, string $toCurrency): int {

        $this->validateAmount($amount);
        if ($fromCurrency === $toCurrency) {
            return $amount;
        }
        return $this->exchange->getConvertedAmount($amount, $fromCurrency, $toCurrency);
    }

    /**
     * @param int $amount
     * @throws InvalidInputException
     */
    private function validateAmount(int $amount): void
    {
        if (empty($amount) || is_nan($amount) || $amount <= 0) {
            throw new InvalidInputException();
        }
    }
}
