<?php

namespace Arifpay\Arifpay\Helper;

use Illuminate\Support\Carbon;

class ArifpaySupport
{
    public static function getExpireDateFromDate(Carbon $date)
    {
        return $date->toDateTimeLocalString();
    }
}
