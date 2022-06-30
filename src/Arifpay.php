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
use Arifpay\Arifpay\Lib\Exception\ArifpayUnAuthorizedException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class Arifpay
{
    public $DEFAULT_HOST = 'https://gateway.arifpay.net';
    public $API_VERSION = '/v0';
    public $PACKAGE_VERSION = '1.1.1';
    public $DEFAULT_TIMEOUT = 1000 * 60 * 2;
    private $http_client;
    public string $apikey;

    public function __construct($apikey)
    {
        $this->apikey = $apikey;
        $this->http_client = Http::baseUrl("$this->DEFAULT_HOST/$this->API_VERSION")
            ->timeout($this->DEFAULT_TIMEOUT)
            ->withHeaders(
                [
                    'content-type' => 'application/json',
                    'Accept' => 'application/json',
                    'x-arifpay-key' => $this->apikey,
                ]
            );
    }

    public function checkout()
    {
        return $this;
    }

    public function create(ArifpayCheckoutRequest $arifpayCheckoutRequest, ArifpayOptions $option = null): ArifpayCheckoutResponse
    {
        if ($option == null) {
            $option = new ArifpayOptions(false);
        }

        try {
            $basePath = $option->sandbox ? '/sandbox' : '';
            $response = $this->http_client->post("$basePath/checkout/session",  $arifpayCheckoutRequest->jsonSerialize());
            $response->throw();

            $arifAPIResponse = ArifpayAPIResponse::fromJson($response->json());

            return ArifpayCheckoutResponse::fromJson($arifAPIResponse->data);
        } catch (ConnectionException $e) {
            throw new ArifpayNetworkException();
        } catch (RequestException $e) {
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
            $response = $this->http_client->get("$basePath/checkout/session/$session_iD");
            $response->throw();

            $arifAPIResponse = ArifpayAPIResponse::fromJson($response->json());

            return ArifpayCheckoutSession::fromJson($arifAPIResponse->data);
        } catch (ConnectionException $e) {
            throw new ArifpayNetworkException();
        } catch (RequestException $e) {
            $this->__handleException($e);

            throw $e;
        }
    }

    private function __handleException(RequestException $e)
    {
        if ($e->response) {
            if ($e->response->status() == 401) {
                throw new ArifpayUnAuthorizedException('Invalid authentication credentials');
            }
            if ($e->response->status() === 400) {
                throw new ArifpayBadRequestException($e->response->data["msg"]);
            }

            throw new ArifpayException($e->response->data["msg"]);
        } else {
            throw new ArifpayNetworkException();
        }
    }
}
