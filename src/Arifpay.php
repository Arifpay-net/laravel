<?php

namespace Arifpay\Arifpay;

use Arifpay\Arifpay\Lib\ArifpayAPIResponse;
use Arifpay\Arifpay\Lib\ArifpayCheckoutRequest;
use Arifpay\Arifpay\Lib\ArifpayCheckoutResponse;
use Arifpay\Arifpay\Lib\ArifpayCheckoutSession;
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
    public $API_VERSION = '/v0';
    public $PACKAGE_VERSION = '1.2.3';
    public $DEFAULT_TIMEOUT = 1000 * 60 * 2;

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
    }

    public function create(ArifpayCheckoutRequest $arifpayCheckoutRequest, ArifpayOptions $option = null): ArifpayCheckoutResponse
    {
        if ($option == null) {
            $option = new ArifpayOptions(false);
        }

        try {
            $basePath = $option->sandbox ? '/sandbox' : '';
            $response = $this->http_client->post("{$this->API_VERSION}$basePath/checkout/session", [
                RequestOptions::JSON => $arifpayCheckoutRequest->jsonSerialize(),
            ]);

            $arifAPIResponse = ArifpayAPIResponse::fromJson(json_decode($response->getBody(), true));

            return ArifpayCheckoutResponse::fromJson($arifAPIResponse->data);
        } catch (ConnectionErrorException $e) {
            throw new ArifpayNetworkException();
        } catch (ClientException $e) {
            $this->__handleException($e);

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
            $response = $this->http_client->get("{$this->API_VERSION}$basePath/checkout/session/$session_iD");

            $arifAPIResponse = ArifpayAPIResponse::fromJson(json_decode($response->getBody(), true));

            return ArifpayCheckoutSession::fromJson($arifAPIResponse->data);
        } catch (ConnectionErrorException $e) {
            throw new ArifpayNetworkException();
        } catch (RequestException $e) {
            $this->__handleException($e);

            throw $e;
        }
    }

    private function __handleException(ClientException $e)
    {
        $response = $e->getResponse();
        if ($response) {
            if ($response->getStatusCode() == 401) {
                throw new ArifpayUnAuthorizedException('Invalid authentication credentials', $e);
            }
            if ($response->getStatusCode() === 400) {
                $responseBodyAsString = $response->getBody()->getContents();
                $msg = "Invalid Request, check your Request body.";
                if (! empty($responseBodyAsString)) {
                    $responseJson = json_decode($responseBodyAsString, true);
                    $msg = $responseJson["msg"];
                }

                throw new ArifpayBadRequestException($msg, $e);
            }
            if ($response->getStatusCode() === 404) {
                $responseBodyAsString = $response->getBody()->getContents();
                $msg = "Invalid Request, Not found.";
                if (! empty($responseBodyAsString)) {
                    $responseJson = json_decode($responseBodyAsString, true);
                    $msg = $responseJson["msg"];
                }

                throw new ArifpayNotFoundException($msg, $e);
            }

            throw new ArifpayException($e->response->data["msg"], $e);
        } else {
            throw new ArifpayNetworkException($e);
        }
    }
}
