# Laravel: Omnipay

**An Omnipay bridge for Laravel 5**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mayoz/laravel-omnipay.svg?style=flat-square)](https://packagist.org/packages/mayoz/laravel-omnipay)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

## Install

Via Composer

``` bash
$ composer require mayoz/laravel-omnipay
```

### Configuration

After installing the Omnipay library, register the `Mayoz\Omnipay\OmnipayServiceProvider` in your `config/app.php` configuration file:

```php
    'providers' => [
        // Other service providers...

        Mayoz\Omnipay\OmnipayServiceProvider::class,
    ],
```

Also, add the `Omnipay` facade to the `aliases` array in your `app` configuration file:

```php
    'Omnipay' => Mayoz\Omnipay\Facades\Omnipay::class,
```

Finally, publish the configuration files via php `artisan vendor:publish`.

Open the `config/omnipay.php` configuration file and set the default provider connection with `default` key. Define the connections with initialize configurations you want in `providers` key.

```php
    'providers' => [
        'Stripe' => [
            'ApiKey'   => '',
            'testMode' => false,
        ],

        'Iyzico' => [
            'ApiKey'    => '',
            'ApiSecret' => '',
            'testMode'  => false,
        ]
    ],
```

## Omnipay Driver

This package supports when yours driver has been using the Omnipay infrastructure.
Now, add the omnipay provider you want to use. For example:

``` bash
$ composer require omnipay/stripe
# or
$ composer require mayoz/omnipay-iyzico
```

## Usage

Next, you are ready to use. Please see the following examples.

```php
<?php

    namespace App\Http\Controllers;

    use Omnipay;
    use Illuminate\Routing\Controller;

    class HomeController extends Controller
    {
        /**
         * Purchase.
         *
         * @return Response
         */
        public function purchase()
        {
            // Send purchase request
            $response = Omnipay::purchase([
                'amount' => '10.00',
                'currency' => 'USD',
                'card' => [
                    'number' => '4242424242424242',
                    'expiryMonth' => '6',
                    'expiryYear' => '2016',
                    'cvv' => '123'
                ]
            ])->send();

            // Process response
            if ($response->isSuccessful()) {

                // Payment was successful
                print_r($response);

            } elseif ($response->isRedirect()) {

                // Redirect to offsite payment gateway
                $response->redirect();

            } else {

                // Payment failed
                echo $response->getMessage();
            }
        }
    }
```

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/mayoz/laravel-omnipay/issues),
or better yet, fork the library and submit a pull request.

## Security

If you discover any security related issues, please email srcnckr@gmail.com instead of using the issue tracker.

## License

THis package is licensed under [The MIT License (MIT)](LICENSE).

