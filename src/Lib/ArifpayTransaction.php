<?php
namespace Arifpay\Arifpay\Lib;
use JsonSerializable;

class ArifpayTransaction implements JsonSerializable
{

    // TODO: transactionStatus: string; change to enum
    // TODO: paymentType: string; change to enum


    public $id;
    public $transaction_id;
    public $payment_type;
    public $payment_status;
    public $created_at;
    public $updated_at;
    function __construct($id, $transaction_id, $payment_type, $payment_status, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->transaction_id = $transaction_id;
        $this->payment_type = $payment_type;
        $this->payment_status = $payment_status;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "transactionId" => $this->transaction_id,
            "paymentType" => $this->payment_type,
            "paymentStatus" => $this->payment_status,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at
        ];
    }

    static function fromJson($data)
    {
        return new ArifpayTransaction($data["id"], $data["transactionId"], $data["paymentType"], $data["paymentStatus"], $data["createdAt"], $data["updatedAt"]);
    }
}