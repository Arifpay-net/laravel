<?php
namespace Arifpay\Arifpay\Interface;

class ArifpayAPIResponse
{
    function __construct(public bool $error, public ?string $msg, public mixed $data)
    {
    }

    static function fromJson($json){
        return new ArifpayAPIResponse($json["error"], $json["msg"], $json["data"]);
    }   
}
