<?php
namespace Arifpay\Arifpay\Lib;

class ArifpayOptions
{
    public $sandbox;
    function __construct($sandbox)
    {
        $this->sandbox = $sandbox;
    }
}