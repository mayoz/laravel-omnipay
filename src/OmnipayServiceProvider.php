<?php

/*
 * This file is part of Laravel Omnipay.
 *
 * (c) Sercan Çakır <srcnckr@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mayoz\Omnipay;

use Illuminate\Support\ServiceProvider;

/**
 * Omnipay service provider class.
 *
 * @package   Omnipay
 * @author    Sercan Çakır <srcnckr@gmail.com>
 * @license   MIT License
 * @copyright 2015
 */
class OmnipayServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/../config/omnipay.php' => config_path('omnipay.php')
        ], 'config');

        $this->app['omnipay'] = $this->app->share(function ($app) {
            return new Omnipay($app, new Factory);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['omnipay'];
    }
}
