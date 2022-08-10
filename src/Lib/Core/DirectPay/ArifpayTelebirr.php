<?php

namespace Arifpay\Arifpay\Lib\Core\DirectPay;

use Arifpay\Arifpay\ArifPay;
use Arifpay\Arifpay\Helper\ArifpaySupport;
use Arifpay\Arifpay\Lib\ArifpayAPIResponse;
use Arifpay\Arifpay\Lib\ArifpayTransferResponse;
use Arifpay\Arifpay\Lib\Exception\ArifpayNetworkException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use League\Flysystem\ConnectionErrorException;

class ArifpayTelebirr
{
    public $http_client;

    public function __construct($http_client)
    {
        $this->http_client = $http_client;
    }

    public function pay($checksessionID): ArifpayTransferResponse
    {
        try {
            $response = $this->http_client->post(Arifpay::API_VERSION."/checkout/telebirr/direct/transfer", [
                RequestOptions::JSON => [
                    "sessionId" => $checksessionID,
                ],
            ]);

            $arifAPIResponse = ArifpayAPIResponse::fromJson(json_decode($response->getBody(), true));

            return ArifpayTransferResponse::fromJson($arifAPIResponse->data);
        } catch (ConnectionErrorException $e) {
            throw new ArifpayNetworkException();
        } catch (ClientException $e) {
            ArifpaySupport::__handleException($e);

            throw $e;
        }
    }
}
