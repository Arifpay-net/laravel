<?php

namespace Arifpay\Arifpay\Interface\Exception;

class ArifpayUnAuthorizedException extends Exception
{
    public function __construct(public string $msg)
    {
    }
}
