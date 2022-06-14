<?php

namespace Arifpay\Arifpay\Interface;

class ArifpayCheckoutResponse
{
    public function __construct(
        public string $session_id,
        public string $payment_url,
        public string $cancel_url,
        public float $total_amount
    ) {
    }

    public static function fromJson(array $data)
    {
        return new ArifpayCheckoutResponse($data["sessionId"], $data["paymentUrl"], $data["cancelUrl"], $data["totalAmount"]);
    }
}
