<?php
namespace Opeepl\BackendTest\Service;

use Opeepl\BackendTest\Exceptions\UnsupportedCurrencyException;
use Opeepl\BackendTest\Exceptions\InvalidInputException;
use PHPUnit\Framework\TestCase;

class ExchangeRateServiceTest extends TestCase {

    /** @var ExchangeRateService  */
    protected $exchangeRateService;

    public function setUp(): void {
        $this->exchangeRateService = new ExchangeRateService();
    }

    /**
     * @test
     */
    public function getSupportedCurrenciesTest(): void {
        $currencies = $this->exchangeRateService->getSupportedCurrencies();

        $this->assertContains('USD', $currencies, 'Expected USD to be a supported currency');
        $this->assertContains('EUR', $currencies, 'Expected EUR to be a supported currency');
        $this->assertContains('DKK', $currencies, 'Expected DKK to be a supported currency');
        $this->assertContains('CAD', $currencies, 'Expected CAD to be a supported currency');
    }

    /**
     * @test
     */
    public function getExchangeAmountEURToDKKTest(): void  {
        $amount = $this->exchangeRateService->getExchangeAmount(100, 'EUR', 'DKK');

        // Because of the fixed-rate policy between DKK and EUR, we should be able to expect 1 EUR to be between 7.4 and 7.6.
        $this->assertTrue(740 < $amount && $amount < 760);
    }

    /**
     * @test
     */
    public function getExchangeAmountUSDToCADTest() : void {
        $amount = $this->exchangeRateService->getExchangeAmount(200, 'USD', 'CAD');

        // For the sake of simplicity, we expect USD to CAD to be between 1.2 and 1.45.
        $this->assertTrue(240 < $amount && $amount < 290);
    }

    /**
     * @test
     */
    public function getExchangeAmountUSDToUSDTest() : void {
        $amount = $this->exchangeRateService->getExchangeAmount(200, 'USD', 'USD');

        $this->assertEquals(200, $amount);
    }

    /**
     * @test
     */
    public function negativeAmountTest() : void {
        $this->expectException(InvalidInputException::class);
        $this->exchangeRateService->getExchangeAmount(-200, 'USD', 'USD');
    }

    /**
     * @test
     */
    public function unsupportedToCurrencyTest() : void {
        $this->expectException(UnsupportedCurrencyException::class);
        $this->exchangeRateService->getExchangeAmount(200, 'USD', 'PKR');
    }


    /**
     * @test
     */
    public function unsupportedFromCurrencyTest() : void {
        $this->expectException(UnsupportedCurrencyException::class);
        $this->exchangeRateService->getExchangeAmount(200, 'PKR', 'USD');
    }

    /**
     * @test
     */
    public function zeroAmountTest() : void {
        $this->expectException(InvalidInputException::class);
        $this->exchangeRateService->getExchangeAmount(0, 'USD', 'USD');
    }
}
