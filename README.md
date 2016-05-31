TransactPRO PHP integration
================
[![Build Status](https://travis-ci.org/TransactPRO/transactpro-integration-php.png?branch=master)](https://travis-ci.org/TransactPRO/transactpro-integration-php)
[![Coverage Status](https://coveralls.io/repos/TransactPRO/transactpro-integration-php/badge.svg?branch=master)](https://coveralls.io/r/TransactPRO/transactpro-integration-php?branch=master)
[![Total Downloads](https://poser.pugx.org/transact-pro/gate/downloads.png)](https://packagist.org/packages/transact-pro/gate)
[![Latest Stable Version](https://poser.pugx.org/transact-pro/gate/v/stable.svg)](https://packagist.org/packages/transact-pro/gate)
[![License](https://poser.pugx.org/transact-pro/gate/license.svg)](https://packagist.org/packages/transact-pro/gate)

Library provide ability to make requests to TransactPRO Gateway API.  
Library are supported by me, and not by TransactPRO. So, submit all requests, issues and questions directly here (on GitHub).
Library provided as is.  
You must adopt library for your projects by yourselves, I only provide basic functionality to make requests.

# Installation
### Composer
Recommended way of installation is through [composer](http://getcomposer.org/).  
Add to your composer.json:
```javascript
"require": {
    "transact-pro/gate": "v1.0.0"
}
```
And then install with:
```bash
$ composer.phar install
```

### Manual
You can manually download library and use autoloader.
```php
require_once 'lib/autoloader.php'
```

# Usage
### Create gate client
| Field     | Mandatory | Type   | Description                                                          |
|-----------|-----------|--------|----------------------------------------------------------------------|
| apiUrl    | yes       | string | Api URL. Can be aquired via Integration manual.                      |
| guid      | yes       | string | Merchant GUID.                                                       |
| pwd       | yes       | string | Unecrypted password. It will be encrypted by client.                 |
| verifySSL | no        | bool   | Default: ```true```. Must be set to ```false``` for test environment |

#### Basic client
```php
use TransactPRO\Gate\GateClient;

$gateClient = new GateClient(array(
	'apiUrl'    => 'https://www.payment-api.com',
    'guid'      => 'AAAA-AAAA-AAAA-AAAA',
    'pwd'       => '111'
));

```

#### Client with disabled SSL check.
```php
use TransactPRO\Gate\GateClient;

$gateClient = new GateClient(array(
	'apiUrl'    => 'https://www.payment-api.com',
    'guid'      => 'AAAA-AAAA-AAAA-AAAA',
    'pwd'       => '111',
    'verifySSL' => false
));

```
### Actions
GateClient instance provide number of actions, such as 'charge' or 'status_request'.
All data passed into action are validated and if mandatory field missed, then exception will be raised.
Please check integration manual, to get more info about required data for each action.

#### Init
```php
$response = $gateClient->init(array(
    'rs'                      => 'AAAA',
    'merchant_transaction_id' => '1',
    'user_ip'                 => '127.0.0.1',
    'description'             => 'Test description',
    'amount'                  => '100',
    'currency'                => 'LVL',
    'name_on_card'            => 'Vasyly Pupkin',
    'street'                  => 'Main street 1',
    'zip'                     => 'LV-0000',
    'city'                    => 'Riga',
    'country'                 => 'LV',
    'state'                   => 'NA',
    'email'                   => 'email@example.lv',
    'phone'                   => '+371 11111111',
    'card_bin'                => '511111',
    'bin_name'                => 'BANK',
    'bin_phone'               => '+371 11111111',
    'merchant_site_url'       => 'http://www.example.com'
));
```

#### Charge
```php
$response = $gateClient->charge(array(
    'f_extended'          => '5',
    'init_transaction_id' => '13hpf5rp1e0ss72dypjnhalzn1wmrkfmsjtwzocg',
    'cc'                  => '5111111111111111',
    'cvv'                 => '111',
    'expire'              => '01/20'
));
```

#### Init DMS
```php
$response = $gateClient->initDms(array(
    'rs'                      => 'AAAA',
    'merchant_transaction_id' => microtime(true),
    'user_ip'                 => '127.0.0.1',
    'description'             => 'Test description',
    'amount'                  => '100',
    'currency'                => 'LVL',
    'name_on_card'            => 'Vasyly Pupkin',
    'street'                  => 'Main street 1',
    'zip'                     => 'LV-0000',
    'city'                    => 'Riga',
    'country'                 => 'LV',
    'state'                   => 'NA',
    'email'                   => 'email@example.lv',
    'phone'                   => '+371 11111111',
    'card_bin'                => '511111',
    'bin_name'                => 'BANK',
    'bin_phone'               => '+371 11111111',
    'merchant_site_url'       => 'http://www.example.com'
));
```

#### Make hold
```php
$response = $gateClient->makeHold(array(
    'f_extended'          => '5',
    'init_transaction_id' => '13hpf5rp1e0ss72dypjnhalzn1wmrkfmsjtwzocg',
    'cc'                  => '5111111111111111',
    'cvv'                 => '111',
    'expire'              => '01/20'
));
```

#### Charge hold
```php
$response = $gateClient->chargeHold(array(
    'init_transaction_id' => '13hpf5rp1e0ss72dypjnhalzn1wmrkfmsjtwzocg'
));
```

#### Cancel DMS
```php
$response = $gateClient->cancelDms(array(
    'init_transaction_id' => '13hpf5rp1e0ss72dypjnhalzn1wmrkfmsjtwzocg',
    'amount_to_refund'    => '100'
));
```

#### Refund
```php
$response = $gateClient->refund(array(
    'init_transaction_id' => '13hpf5rp1e0ss72dypjnhalzn1wmrkfmsjtwzocg',
    'amount_to_refund'    => '100'
));
```

#### Status request
```php
$response = $gateClient->statusRequest(array(
    'request_type'        => 'transaction_status',
    'init_transaction_id' => '13hpf5rp1e0ss72dypjnhalzn1wmrkfmsjtwzocg',
    'f_extended'          => '5'
));
```
### Response
Response instance returned as action result.

#### isSuccess
To check if curl request was successful, you can use ```isSuccessful``` method;
```php
$response->isSuccessful(); // Return bool.
```

#### getResponseContent
To get raw response you can use ```getResponseContent```.

If request was successful, then API response was returned. If not, then curl_error was returned.
```php
$response->getResponseContent(); // Return string.
$response->getParsedResponse();  // Parsed response content.
```

# Tests
If you wish to run tests, you need to install development dependencies:
```bash
$ composer.phar install --dev
```
And then run them with:
```bash
$ vendor/bin/phpunit
```
