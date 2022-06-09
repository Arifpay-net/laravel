<?php

use Arifpay\Arifpay\Arifpay;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('Creates Instance', function () {
    $this->assertTrue(new Arifpay('myAPI') instanceof Arifpay);
});

it('Check API key is Set', function () {
    $arifpay = new Arifpay('myAPI');
    $this->assertTrue($arifpay->apikey == "myAPI");
});
