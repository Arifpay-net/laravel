<?php

namespace Arifpay\Arifpay\Interface;

class ArifpayAPIResponse
{
    public function __construct(public bool $error, public ?string $msg, public mixed $data)
    {
    }

    public static function fromJson($json)
    {
        return new ArifpayAPIResponse($json["error"], $json["msg"], $json["data"]);
    }
}
