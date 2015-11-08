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

use BadMethodCallException;

/**
 * Omnipay gateway class.
 *
 * @package   Omnipay
 * @author    Sercan Çakır <srcnckr@gmail.com>
 * @license   MIT License
 * @copyright 2015
 */
class Omnipay
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The factory instance.
     *
     * @var \Mayoz\Omnipay\Factory
     */
    protected $factory;

    /**
     * The array of resolved gateways.
     *
     * @var array
     */
    protected $gateways = [];

    /**
     * Create a new omnipay manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @param  \Mayoz\Omnipay\Factory  $factory
     * @param  void
     */
    public function __construct($app, Factory $factory, $defaults = array())
    {
        $this->app = $app;
        $this->factory = $factory;
    }

    /**
     * Get an instance of the specified gateway.
     *
     * @param  string  $name
     * @return \Omnipay\Common\AbstractGateway
     */
    public function gateway($name = null)
    {
        $name = $name ?: $this->getDefaultGateway();

        if (! isset($this->gateways[$name])){
            $gateway = $this->factory->create($name, null, $this->app['request']);

            $gateway->initialize($this->getConfig($name));

            $this->gateways[$name] = $gateway;
        }

        return $this->gateways[$name];
    }

    /**
     * Get the default gateway name.
     *
     * @return string
     */
    public function getDefaultGateway()
    {
        return $this->app['config']['omnipay.default'];
    }

    /**
     * Set the default gateway name.
     *
     * @param  string  $name
     * @return void
     */
    public function setDefaultGateway($name)
    {
        $this->app['config']['omnipay.default'] = $name;
    }

    /**
     * Get the gateway configuration.
     *
     * @param  string  $name
     * @return array
     */
    protected function getConfig($name)
    {
        return $this->app['config']->get("omnipay.providers.{$name}", []);
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $gateway = $this->gateway();

        if (method_exists($gateway, $method)) {
            return call_user_func_array([$gateway, $method], $parameters);
        }

        throw new BadMethodCallException("Method [{$method}] is not supported by the gateway [{$gateway}].");
    }
}
