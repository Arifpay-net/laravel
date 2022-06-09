<?php

namespace Arifpay\Arifpay\Interface\Exception;

class ArifpayException extends Exception
{
    public function __construct(public string $msg)
    {
    }
}
