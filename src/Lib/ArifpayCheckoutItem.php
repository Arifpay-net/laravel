<?php

namespace Arifpay\Arifpay\Lib;

use JsonSerializable;


class ArifpayCheckoutItem implements JsonSerializable
{


    public $name;
     public $quantity;
      public $price;
       public $image; 
       public $description;
    function __construct( $name,  $quantity,  $price,  $image = null,  $description = null)
    {

        $this->name=$name;
        $this->quantity=$quantity;
        $this->price=$price;
        $this->image=$image;
    }


    function jsonSerialize()
    {
        return [
            "name"  => $this->name,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "image" => $this->image,
            "description" => $this->description
        ];
    }

    static function fromJson(array $data)
    {
        return new ArifpayCheckoutItem($data['name'], $data['quantity'], $data['price'], isset($data['image']) ? $data['image'] : null, isset($data['description']) ? $data['description'] : null);
    }
}
