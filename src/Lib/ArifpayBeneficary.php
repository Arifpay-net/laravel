<?php

namespace Arifpay\Arifpay\Lib;

use JsonSerializable;

class ArifpayBeneficary implements JsonSerializable
{
    public $id;
    public $account_number;
    public $bank;
    public $amount;

    // TODO bank: any  change to enum?
    public function __construct($id, $account_number, $bank, $amount)
    {
        $this->id = $id;
        $this->bank = $bank;
        $this->amount = $amount;
        $this->account_number = $account_number;
    }

    public static function fromJson(array $data)
    {
        return new ArifpayBeneficary(isset($data['id']) ? $data['id'] : null, $data['accountNumber'], $data['bank'], $data['amount']);
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "accountNumber" => $this->account_number,
            "bank" => $this->bank,
            "amount" => $this->amount,
        ];
    }
}
