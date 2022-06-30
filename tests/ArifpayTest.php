<?php

use Arifpay\Arifpay\Lib\Arifpay;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('Creates Instance', function () {
    $this->assertTrue(new Arifpay('myAPI') instanceof Arifpay);
});

it('Is Latest Version Instance', function () {
    $this->assertTrue((new Arifpay('myAPI'))->PACKAGE_VERSION == '1.1.2');
});

it('Check API key is Set', function () {
    $arifpay = new Arifpay('myAPI');
    $this->assertTrue($arifpay->apikey == "myAPI");
});
