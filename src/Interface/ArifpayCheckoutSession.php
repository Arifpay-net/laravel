<?php

namespace Arifpay\Arifpay\Interface;

class ArifpayCheckoutSession
{
    public function __construct(public int $id, public  ?ArifpayTransaction $transcation, public float $totalAmount, public bool $test,  public string $uuid, public string $created_at, public string $update_at)
    {
    }

    public static function fromJson(array $json)
    {
        return new ArifpayCheckoutSession($json["id"], isset($json["transaction"]) ? ArifpayTransaction::fromJson($json["transaction"]) : null, $json["totalAmount"], $json["test"], $json["uuid"], $json["createdAt"],  $json["updatedAt"]);
    }
}
