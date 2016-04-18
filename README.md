# KiezelPay PHP Client

The official API Client for the KiezelPay Pebble app payment system.
Currently supports checking the payment status of a user, and providing the payment code, trial expiry, and licensed status.

## Install

Via Composer

``` bash
$ composer require kiezelpay/client
```

## Usage

``` php
// Initiate App client
$app = new KiezelPay\Client\App($appId);

// Check payment status for specified user and device
$status = $app->status($accountToken, $deviceId);

// User is licensed
if ($status->isLicensed()) {
    // ...
}

// Payment code available
if ($status->isUnlicensed()) {
    // ...
}

// User is in trial period
if ($status->isTrial()) {
    // ...
}
```

## Contributing

Contributions are welcome, and we accept contributions via Pull Requests.

Please follow the [PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md),
write tests for any new or changed code, and document any changes.

## License

The MIT License (MIT). Please see [LICENSE.md](LICENSE.md) for more information.

## Security

If you discover any security related issues, please email [stephen@rees-carter.net](mailto:stephen@rees-carter.net) instead of using the issue tracker.

## Change log

### 2016-04-19 - v1.0.1

**Fixes**

- Bugfix: Guzzle v6 doesn't support `->json()`.

### 2016-04-19 - v1.0.0 - Initial Release

**Added**

- Payment Status API check.
