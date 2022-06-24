<?php
namespace Arifpay\Arifpay\Lib;

use JsonSerializable;

class ArifpayCheckoutResponse implements JsonSerializable

{
    public $session_id;
    public $payment_url;
    public $cancel_url;
    public $total_amount;
    function __construct(
        $session_id,
        $payment_url,
        $cancel_url,
        $total_amount

        )
    {

        $this->session_id = $session_id;
        $this->payment_url = $payment_url;
        $this->cancel_url = $cancel_url;
        $this->total_amount = $total_amount;
    }

    public function jsonSerialize(){
        return [
            "session_id" => $this->session_id,
            "payment_url" => $this->payment_url,
            "cancel_url" => $this->cancel_url,
            "total_amount" => $this->total_amount
        ];
    } 


    static function fromJson($data)
    {
        return new ArifpayCheckoutResponse($data->sessionId, $data->paymentUrl, $data->cancelUrl, $data->totalAmount);
    }
}
