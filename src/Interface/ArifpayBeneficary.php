<?php
namespace Arifpay\Arifpay\Interface;
use JsonSerializable;


class ArifpayBeneficary implements JsonSerializable
{

    // TODO bank: any  change to enum?
    function __construct(public ?int $id, public string $account_number, public string $bank, public string $amount)
    {
    }

    static function fromJson(array $data)
    {
        return new ArifpayBeneficary(isset($data['id'])? $data['id'] :null, $data['accountNumber'], $data['bank'], $data['amount']);
    }

    function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "accountNumber" => $this->account_number,
            "bank" => $this->bank,
            "amount" => $this->amount
        ];
    }
}
