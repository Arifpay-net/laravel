<?php 
namespace Arifpay\Arifpay\Lib\Exception;
use Exception;

class ArifpayUnAuthorizedException extends Exception{
    public $msg;
    public function __construct($msg){
        $this->msg = $msg;
    }
}
