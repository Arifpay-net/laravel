<?php

namespace Arifpay\Arifpay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Arifpay\Arifpay\Arifpay
 */
class Arifpay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'arifpay';
    }
}
