<?php
namespace Arifpay\Arifpay\Lib\Core\DirectPay;

use Arifpay\Arifpay\ArifPay;
use Arifpay\Arifpay\Helper\ArifpaySupport;
use Arifpay\Arifpay\Lib\ArifpayAPIResponse;
use Arifpay\Arifpay\Lib\ArifpayCheckoutRequest;
use Arifpay\Arifpay\Lib\ArifpayCheckoutResponse;
use Arifpay\Arifpay\Lib\ArifpayCheckoutSession;
use Arifpay\Arifpay\Lib\ArifpayTransferResponse;
use Arifpay\Arifpay\Lib\ArifpayOptions;
use Arifpay\Arifpay\Lib\Exception\ArifpayNetworkException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use League\Flysystem\ConnectionErrorException;

class ArifpayAwashWallet
{

    public $http_client;
  

    public function __construct($http_client)
    {
        $this->http_client = $http_client;
    }

    public function pay($checksessionID, $phoneNumber): ArifpayTransferResponse
    {

        try {
            $response = $this->http_client->post(Arifpay::API_VERSION."/checkout/awash/wallet/direct/transfer", [
                RequestOptions::JSON => [
                    "sessionId" => $checksessionID,
                    "phoneNumber" => $phoneNumber
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

    public function verify($checksessionID, $otp, $fail=false): ArifpayTransferResponse
    {

        try {
            $response = $this->http_client->post(Arifpay::API_VERSION."/checkout/awash/wallet/direct/verifyOTP", [
                RequestOptions::JSON => [
                    "sessionId" => $checksessionID,
                    "paymentRunMode" => $fail ? "FAIL" : "SUCCESS",
                    "otp" => $otp
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
