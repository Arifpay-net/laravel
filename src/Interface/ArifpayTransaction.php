<?php

namespace Arifpay\Arifpay\Interface;

use JsonSerializable;

class ArifpayTransaction implements JsonSerializable
{
    // TODO: transactionStatus: string; change to enum
    // TODO: paymentType: string; change to enum

    public function __construct(public int $id, public string $transaction_id, public string $payment_type,  public string $payment_status, public string $created_at, public string $updated_at)
    {
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "transactionId" => $this->transaction_id,
            "paymentType" => $this->payment_type,
            "paymentStatus" => $this->payment_status,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
        ];
    }

    public static function fromJson($data)
    {
        return new ArifpayTransaction($data["id"], $data["transactionId"], $data["paymentType"], $data["paymentStatus"], $data["createdAt"], $data["updatedAt"]);
    }
}
