<?php 
namespace Arifpay\Arifpay\Lib\Exception;
use Exception;


class ArifpayException extends Exception{
    public $msg;
    public function __construct($msg){
        $this->msg = $msg;
    }
}
