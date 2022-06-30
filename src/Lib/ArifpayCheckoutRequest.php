<?php

namespace Arifpay\Arifpay\Lib;

use JsonSerializable;

class ArifpayCheckoutRequest implements JsonSerializable
{
    public $cancel_url;
    public $nonce;
    public $error_url;
    public $notify_url;
    public $success_url;
    public $paymentMethods;
    public $expireDate;
    public $items;
    public $beneficiaries;

    public function __construct(
        $cancel_url,
        $nonce,
        $error_url,
        $notify_url,
        $success_url,
        $paymentMethods,
        $expireDate,
        $items,
        $beneficiaries
    ) {
        $this->cancel_url = $cancel_url;
        $this->nonce = $nonce;
        $this->error_url = $error_url;
        $this->notify_url = $notify_url;
        $this->success_url = $success_url;
        $this->paymentMethods = $paymentMethods;
        $this->expireDate = $expireDate;
        $this->items = $items;
        $this->beneficiaries = $beneficiaries;
    }

    public function jsonSerialize()
    {
        return [
            'cancelUrl' => $this->cancel_url,
            'nonce' => $this->nonce,
            'errorUrl' => $this->error_url,
            'notifyUrl' => $this->notify_url,
            'successUrl' => $this->success_url,
            'paymentMethods' => $this->paymentMethods,
            'expireDate' => $this->expireDate,
            'items' => $this->items,
            'beneficiaries' => $this->beneficiaries,
        ];
    }
}
