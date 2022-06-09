<?php 
namespace Arifpay\Arifpay\Interface\Exception;

class ArifpayBadRequestException extends Exception{
    public function __construct(public string $msg){}
}
