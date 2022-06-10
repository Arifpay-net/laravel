
[<img src="https://arifpay.net/brand/ArifPay-Logo-(Full-Color).png" />](https://arifpay.net)

# Arifpay Laravel API Package.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/arifpay/arifpay.svg?style=flat-square)](https://packagist.org/packages/arifpay/arifpay)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/arifpay/arifpay/run-tests?label=tests)](https://github.com/arifpay/arifpay/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/arifpay/arifpay/Check%20&%20fix%20styling?label=code%20style)](https://github.com/arifpay/arifpay/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/arifpay/arifpay.svg?style=flat-square)](https://packagist.org/packages/arifpay/arifpay)

## Documentation

See the [`Developer` API docs](https://developer.arifpay.net/).


## Installation

You can install the package via composer:

```bash
composer require arifpay/arifpay
```

## For Laravel version <= 5.4

With version 5.4 or below, you must register your facades manually in the aliases section of the config/app.php configuration file.


```json config/app.php

"aliases": {
            "Arifpay": "Arifpay\\Arifpay\\Facades\\Arifpay"
        }
```

## Usage

The package needs to be configured with your account's API key, which is
available in the [Arifpay Dashboard](https://dashboard.arifpay.net/app/api). Require it with the key's
value. After install the package. you can use as follow.

```php
use Arifpay\Arifpay\Arifpay;

...

$arifpay = new Arifpay('your-api-key');

```


## Creating Checkout Session

After importing the `arifpay` package, use the checkout property of the Arifpay instance to create or fetch `checkout sessions`.


```php

use Arifpay\Arifpay\Arifpay;
use Arifpay\Arifpay\Helper\ArifpaySupport;
use Arifpay\Arifpay\Interface\ArifpayBeneficary;
use Arifpay\Arifpay\Interface\ArifpayCheckoutItem;
use Arifpay\Arifpay\Interface\ArifpayCheckoutRequest;
use Arifpay\Arifpay\Interface\ArifpayOptions;

use Illuminate\Support\Carbon;

$arifpay = new Arifpay('your-api-key');
$d = new  Carbon();
$d->setMonth(10);
$expired = ArifpaySupport::getExpireDateFromDate($d);
$data = new ArifpayCheckoutRequest(
    cancel_url: 'https://api.arifpay.com',
    error_url: 'https://api.arifpay.com',
    notify_url: 'https://gateway.arifpay.net/test/callback',
    expireDate: $expired,
    nonce: floor(rand() * 10000) . "",
    beneficiaries: [
        ArifpayBeneficary::fromJson([
            "accountNumber" => '01320811436100',
            "bank" => 'AWINETAA',
            "amount" => 10.0,
        ]),
    ],
    paymentMethods: ["CARD"],
    success_url: 'https://gateway.arifpay.net',
    items: [
        ArifpayCheckoutItem::fromJson([
            "name" => 'Bannana',
            "price" => 10.0,
            "quantity" => 1,
        ]),
    ],
);
$session =  $arifpay->checkout()->create($data, new ArifpayOptions(sandbox: true));
echo $session->session_id;

```

After putting your building  `ArifpayCheckoutRequest` just call the `create` method. Note passing `sandbox: true` option will create the session in test environment.

This is session response object contains the following fields

```js
{
  sessionId: string;
  paymentUrl: string;
  cancelUrl: string;
  totalAmount: number;
}
```

## Getting Session by Session ID

To track the progress of a checkout session you can use the fetch method as shown below:

```php
 $arifpay = new Arifpay('API KEY...');
// A sessionId will be returned when creating a session.
 $session = $arifpay->checkout->fetch('checkOutSessionID', new ArifpayOptions(sandbox: true));
```

The following object represents a session

```php
{
  public int $id, 
  public  ?ArifpayTransaction $transcation, 
  public float $totalAmount, 
  public bool $test,  
  public string $uuid, 
  public string $created_at, 
  public string $update_at
}
```

# Change Log

Released Date: `v1.0.0` June 09, 2022

- Initial Release



## More Information

- [Check Full Example](https://github.com/Arifpay-net/Laravel-sample)
- [REST API Version](https://developer.arifpay.net/docs/checkout/overview)
- [Mobile SDK](https://developer.arifpay.net/docs/clientSDK/overview)
- [Node JS](https://developer.arifpay.net/docs/nodejs/overview)
- [Laravel](https://developer.arifpay.net/docs/laravel/overview)
- [Change Log](https://developer.arifpay.net/docs/laravel/changelog)

## Credits

- [basliel](https://github.com/ba5liel)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
