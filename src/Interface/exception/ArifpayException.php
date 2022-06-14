<?php

namespace Arifpay\Arifpay\Interface\Exception;

use Exception;

class ArifpayException extends Exception
{
    public function __construct(public string $msg)
    {
    }
}
