<?php

namespace Arifpay\Arifpay\Lib\Core;

use Arifpay\Arifpay\ArifPay;
use Arifpay\Arifpay\Helper\ArifpaySupport;
use Arifpay\Arifpay\Lib\ArifpayAPIResponse;
use Arifpay\Arifpay\Lib\ArifpayCheckoutRequest;
use Arifpay\Arifpay\Lib\ArifpayCheckoutResponse;
use Arifpay\Arifpay\Lib\ArifpayCheckoutSession;
use Arifpay\Arifpay\Lib\ArifpayOptions;
use Arifpay\Arifpay\Lib\Exception\ArifpayNetworkException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use League\Flysystem\ConnectionErrorException;

class ArifpayCheckout
{
    // TODO: transactionStatus: string; change to enum
    // TODO: paymentType: string; change to enum


    public $http_client;

    public function __construct($http_client)
    {
        $this->http_client = $http_client;
    }

    public function create(ArifpayCheckoutRequest $arifpayCheckoutRequest, ArifpayOptions $option = null): ArifpayCheckoutResponse
    {
        if ($option == null) {
            $option = new ArifpayOptions(false);
        }

        try {
            $basePath = $option->sandbox ? '/sandbox' : '';
            $response = $this->http_client->post(Arifpay::API_VERSION."$basePath/checkout/session", [
                RequestOptions::JSON => $arifpayCheckoutRequest->jsonSerialize(),
            ]);

            $arifAPIResponse = ArifpayAPIResponse::fromJson(json_decode($response->getBody(), true));

            return ArifpayCheckoutResponse::fromJson($arifAPIResponse->data);
        } catch (ConnectionErrorException $e) {
            throw new ArifpayNetworkException();
        } catch (ClientException $e) {
            ArifpaySupport::__handleException($e);

            throw $e;
        }
    }

    public function fetch(string $session_iD, ArifpayOptions $option = null): ArifpayCheckoutSession
    {
        if ($option == null) {
            $option = new ArifpayOptions(false);
        }

        try {
            $basePath = $option->sandbox ? '/sandbox' : '';
            $response = $this->http_client->get(Arifpay::API_VERSION."$basePath/checkout/session/$session_iD");

            $arifAPIResponse = ArifpayAPIResponse::fromJson(json_decode($response->getBody(), true));

            return ArifpayCheckoutSession::fromJson($arifAPIResponse->data);
        } catch (ConnectionErrorException $e) {
            throw new ArifpayNetworkException();
        } catch (RequestException $e) {
            ArifpaySupport::__handleException($e);

            throw $e;
        }
    }
}
