<?php

namespace Arifpay\Arifpay\Interface\Exception;

use Exception;

class ArifpayBadRequestException extends Exception
{
    public function __construct(public string $msg)
    {
    }
}
