<?php
namespace Arifpay\Arifpay\Interface;
use JsonSerializable;


class ArifpayCheckoutRequest implements JsonSerializable
{

    function __construct(
        public string $cancel_url,
        public string $nonce,
        public string $error_url,
        public string $notify_url,
        public string $success_url,
        public array $paymentMethods,
        public string $expireDate,
        public array $items,
        public array $beneficiaries,
    ) {
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
