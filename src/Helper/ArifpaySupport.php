<?php
namespace Arifpay\Arifpay\Helper;

use Illuminate\Support\Carbon;

class ArifpaySupport
{
     static function getExpireDateFromDate(Carbon $date)
     {
          return $date->format('Y-m-d');
     }
}
