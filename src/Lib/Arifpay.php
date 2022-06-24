<?php

namespace Arifpay\Arifpay\Lib;

use Arifpay\Arifpay\Lib\ArifpayCheckoutRequest;
use Arifpay\Arifpay\Lib\ArifpayOptions;
use Arifpay\Arifpay\Lib\ArifpayCheckoutResponse;
use Arifpay\Arifpay\Lib\ArifpayAPIResponse;
use League\Flysystem\ConnectionErrorException;
use Arifpay\Arifpay\Lib\Exception\ArifpayNetworkException;
use GuzzleHttp\Exception\RequestException;
use Arifpay\Arifpay\Lib\ArifpayCheckoutSession;
use Arifpay\Arifpay\Lib\Exception\ArifpayUnAuthorizedException;
use Arifpay\Arifpay\Lib\Exception\ArifpayBadRequestException;
use Arifpay\Arifpay\Lib\Exception\ArifpayException;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

class ArifPay
{
  public $http_client;
  public $apikey;
  function __construct($apikey)
  {
    $this->apikey = $apikey;
    $this->http_client = new \GuzzleHttp\Client(['headers' => [
      'x-arifpay-key' => $apikey,
      "Content-Type" => "application/json",
      "Accepts" => "application/json"
    ]]);
  }
  public function create(ArifpayCheckoutRequest $arifpayCheckoutRequest, ArifpayOptions $option = null): ArifpayCheckoutResponse
  {
    if ($option == null)
      $option = new ArifpayOptions(false);
    try {
      $basePath = $option->sandbox ? '/sandbox' : '';
      $response = $this->http_client->post("https://gateway.arifpay.net/v0$basePath/checkout/session", [
        RequestOptions::JSON =>  $arifpayCheckoutRequest->jsonSerialize()
      ]);

      $arifAPIResponse = ArifpayAPIResponse::fromJson(json_decode($response->getBody()));


      return ArifpayCheckoutResponse::fromJson($arifAPIResponse->data);
    } catch (ConnectionErrorException $e) {
      throw new ArifpayNetworkException();
    } catch (ClientException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
      $responseJson = json_decode($responseBodyAsString);
      // die(print_r($responseJson, true));
      throw new ArifpayBadRequestException($responseJson->msg, $e);
    } catch (RequestException $e) {
      $this->__handleException($e);
      throw $e;
    }
  }

  public function fetch(string $session_iD, ArifpayOptions $option = null): ArifpayCheckoutSession
  {
    if ($option == null)
      $option = new ArifpayOptions(false);
    try {
      $basePath = $option->sandbox ? '/sandbox' : '';
      $response = $this->http_client->get("https://gateway.arifpay.net/v0$basePath/checkout/session/$session_iD");

      $arifAPIResponse = ArifpayAPIResponse::fromJson(json_decode($response->getBody()));
      return ArifpayCheckoutSession::fromJson($arifAPIResponse->data);
    } catch (ConnectionErrorException $e) {

      throw new ArifpayNetworkException();
    } catch (RequestException $e) {
      $this->__handleException($e);
      throw $e;
    }
  }


  private function __handleException(Exception $e)
  {

    throw new ArifpayNetworkException($e->getMessage());
  }
}
