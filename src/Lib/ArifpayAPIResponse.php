<?php

namespace Arifpay\Arifpay\Lib;

class ArifpayAPIResponse
{
    public $error;
    public $msg;
    public $data;

    public function __construct($error, $msg, $data)
    {
        $this->error = $error;
        $this->msg = $msg;
        $this->data = $data;
    }

    public static function fromJson($json)
    {
        return new ArifpayAPIResponse($json["error"], $json["msg"], $json["data"]);
    }
}
