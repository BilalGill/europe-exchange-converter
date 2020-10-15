<?php


namespace Opeepl\BackendTest\Exchanges;



use Opeepl\BackendTest\Exceptions\ApiNotRespondingException;
use Opeepl\BackendTest\Exceptions\UnsupportedCurrencyException;
use Opeepl\BackendTest\Exceptions\UnexpectedErrorException;
use Opeepl\BackendTest\lib\HttpClient;

class EuropeExchange implements IExchange
{
    const EXCHANGE_URL = "https://api.exchangeratesapi.io/";

    /** @var HttpClient */
    private $httpClient;

    public function __construct(){
        $this->httpClient = new HttpClient();
    }

    /**
     * @return array<string>
     * @throws ApiNotRespondingException
     * @throws UnexpectedErrorException
     */
    public function getCurrencies(): array
    {
        $url = self::EXCHANGE_URL.'latest';
        $response = $this->httpClient->get($url);

        if(!isset($response["rates"]) || !isset($response["base"]))
            throw new UnexpectedErrorException();

        $currencies = array_keys($response["rates"]);
        array_push($currencies, $response["base"]);
        return $currencies;
    }

    /**
     * @param int $amount
     * @param string $fromCurrency
     * @param string $toCurrency
     * @return int
     * @throws ApiNotRespondingException
     * @throws UnsupportedCurrencyException
     * @throws UnexpectedErrorException
     */
    public function getConvertedAmount(int $amount, string $fromCurrency, string $toCurrency): int
    {
        $url = self::EXCHANGE_URL . 'latest?base=' . $fromCurrency;
        $response = $this->httpClient->get($url);

        if(isset($response["error"]))
            throw new UnsupportedCurrencyException($response["error"]);
        else{
            if(!isset($response["rates"]))
                throw new UnexpectedErrorException();
            if(!isset($response["rates"][$toCurrency]))
                throw new UnsupportedCurrencyException();
        }

        $rate = $response["rates"][$toCurrency];
        $convertedAmount = round($rate * $amount);
        return intval($convertedAmount);
    }
}