<?php

namespace Arifpay\Arifpay;

use Arifpay\Arifpay\Lib\ArifpayAPIResponse;
use Arifpay\Arifpay\Lib\ArifpayCheckoutRequest;
use Arifpay\Arifpay\Lib\ArifpayCheckoutResponse;
use Arifpay\Arifpay\Lib\ArifpayCheckoutSession;
use Arifpay\Arifpay\Lib\Core\ArifpayCheckout;
use Arifpay\Arifpay\Lib\Core\ArifpayDirectPay;
use Arifpay\Arifpay\Lib\ArifpayOptions;
use Arifpay\Arifpay\Lib\Exception\ArifpayBadRequestException;
use Arifpay\Arifpay\Lib\Exception\ArifpayException;
use Arifpay\Arifpay\Lib\Exception\ArifpayNetworkException;
use Arifpay\Arifpay\Lib\Exception\ArifpayNotFoundException;
use Arifpay\Arifpay\Lib\Exception\ArifpayUnAuthorizedException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use League\Flysystem\ConnectionErrorException;

class ArifPay
{
    public $http_client;
    public $apikey;

    public $DEFAULT_HOST = 'https://gateway.arifpay.net';
    const API_VERSION = '/v0';
    public static  $PACKAGE_VERSION = '1.2.5';
    public $DEFAULT_TIMEOUT = 1000 * 60 * 2;
    public $checkout;
    public $directPay;

    public function __construct($apikey)
    {
        $this->apikey = $apikey;
        $this->http_client = new Client([
            'base_uri' => $this->DEFAULT_HOST,
            'headers' => [
                'x-arifpay-key' => $apikey,
                "Content-Type" => "application/json",
                "Accepts" => "application/json",
            ],
        ]);
        $this->checkout = new ArifpayCheckout($this->http_client);
        $this->directPay = new ArifpayDirectPay($this->http_client);

    }

    

    
}
