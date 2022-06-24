<?php
namespace Arifpay\Arifpay\Lib;

class ArifpayAPIResponse
{
    public $error;
    public $msg;
    public $data;

    function __construct($error, $msg, $data)
    {
        $this->error = $error;
        $this->msg = $msg;
        $this->data = $data;
    }

    static function fromJson($json)
    {
        return new ArifpayAPIResponse($json->error, $json->msg, $json->data);
    }

}
