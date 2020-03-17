<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CurrencyService;

class CurrencyTest extends TestCase
{
    /** @test **/
    public function test_convert_usd_to_eur()
    {
    	$amount_in_usd=100;
        $this->assertEquals(89, (new CurrencyService())->convert($amount_in_usd, 'usd', 'eur'));
    }
    
    /** @test **/
    public function test_convert_usd_to_gbp()
    {
    	$amount_in_gbp=100;
        $this->assertEquals(0, (new CurrencyService())->convert($amount_in_gbp, 'gbp', 'eur'));
    }
}
