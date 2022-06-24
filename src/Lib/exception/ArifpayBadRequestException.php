<?php

namespace Arifpay\Arifpay\Lib\Exception;

use Exception;
use Throwable;

class ArifpayBadRequestException extends Exception
{
    public $msg;

    // Redefine the exception so message isn't optional
    public function __construct($message, Throwable $previous = null)
    {

        // make sure everything is assigned properly
        parent::__construct($message, 0, $previous);
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": {$this->message}\n";
    }
}
