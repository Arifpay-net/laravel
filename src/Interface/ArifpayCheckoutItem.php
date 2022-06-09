<?php

namespace Arifpay\Arifpay\Interface;

use JsonSerializable;

class ArifpayCheckoutItem implements JsonSerializable
{
    public function __construct(public string $name, public string $quantity, public string $price, public ?string $image = null, public ?string $description = null)
    {
    }

    public function jsonSerialize()
    {
        return [
            "name" => $this->name,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "image" => $this->image,
            "description" => $this->description,
        ];
    }

    public static function fromJson(array $data)
    {
        return new ArifpayCheckoutItem($data['name'], $data['quantity'], $data['price'], isset($data['image']) ? $data['image'] : null, isset($data['description']) ? $data['description'] : null);
    }
}
