<?php

use Arifpay\Arifpay\Arifpay;
use Arifpay\Arifpay\Helper\ArifpaySupport;
use Arifpay\Arifpay\Interface\ArifpayCheckoutResponse;
use Arifpay\Arifpay\Interface\ArifpayOptions;
use Arifpay\Arifpay\Interface\Exception\ArifpayBadRequestException;
use Arifpay\Arifpay\Interface\Exception\ArifpayUnAuthorizedException;
use Illuminate\Support\Carbon;

test('checkout Is istance of  Checkout', function () {
    $arifpay = new Arifpay('myAPI');
    $this->assertTrue($arifpay->checkout() instanceof Arifpay);
});
/*
test('Creates Checkout Session', function () {
    $arifpay = new Arifpay('HrUDdrOv3TV92cgpzpbQ3DakLJtHfYfh');
    $d = new  Carbon();
    $d->setMonth(10);
    $expired = ArifpaySupport::getExpireDateFromDate($d);
    $data = new ArifpayCheckoutRequest(
        cancel_url: 'https://api.arifpay.com',
        error_url: 'https://api.arifpay.com',
        notify_url: 'https://gateway.arifpay.net/test/callback',
        expireDate: $expired,
        nonce: floor(rand() * 10000) . toString(),
        beneficiaries: [
            ArifpayBeneficary::fromJson([
                "accountNumber" => '01320811436100',
                "bank" => 'AWINETAA',
                "amount" => 10.0,
            ]),
        ],
        paymentMethods: ["CARD"],
        success_url: 'https://gateway.arifpay.net',
        items: [
            ArifpayCheckoutItem::fromJson([
                "name" => 'Bannana',
                "price" => 10.0,
                "quantity" => 1,
            ]),
        ],
    );
    $session =  $arifpay->checkout()->create($data, new ArifpayOptions(sandbox: true));
    $this->assertTrue($session instanceof ArifpayCheckoutResponse);
    $this->assertTrue(!is_null($session->sessionId));
});

test('Check API key is Invalid', function () {
    try {
        $arifpay = new Arifpay('myAPI');
        $arifpay->checkout()->fetch('fake', new ArifpayOptions(sandbox: true));
    } catch (ArifpayUnAuthorizedException $e) {

        $this->assertTrue($e instanceof ArifpayUnAuthorizedException);
    }
});

test('Check getting Session', function () {
    $arifpay = new Arifpay('HrUDdrOv3TV92cgpzpbQ3DakLJtHfYfh');
    $session = $arifpay->checkout()->fetch('11bb7352-b228-4c75-9f0d-8a035aeac08b', new ArifpayOptions(sandbox: true));
    $this->assertTrue($session->uuid == "11bb7352-b228-4c75-9f0d-8a035aeac08b");
});

test("Check Production doesn't work with Test key", function () {
    try {
        $arifpay = new Arifpay('HrUDdrOv3TV92cgpzpbQ3DakLJtHfYfh');
        $arifpay->checkout()->fetch('11bb7352-b228-4c75-9f0d-8a035aeac08b', new ArifpayOptions(sandbox: false));
    } catch (ArifpayBadRequestException $e) {
        $this->assertTrue($e instanceof ArifpayBadRequestException);
    }
}); */
