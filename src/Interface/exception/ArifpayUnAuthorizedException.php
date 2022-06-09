<?php

namespace Arifpay\Arifpay\Interface\Exception;

use Exception;

class ArifpayUnAuthorizedException extends Exception
{
    public function __construct(public string $msg)
    {
    }
}
