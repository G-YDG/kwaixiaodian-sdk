# kwaixiaodian-sdk

let php developer easier to access kwaixiaodian api

Install the latest version with

```bash
$ composer require ydg/kwaixiaodian-sdk"
```

## Basic Usage

```php
<?php

use Ydg\KwaixiaodianSdk\Kwaixiaodian;

$app = new Kwaixiaodian([
    'app_key' => 'your app_key',
    'app_secret' => 'your app_secret',
    'sign_secret' => 'your sign_secret',
    'access_token' => 'your access_token',
    'http' => [ // set default options to http client
        'headers' => [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json;charset=UTF-8',
        ],
    ]
]);
$app->user->openUserInfoGet();
```
