<?php

/*
 * This file is part of Laravel Omnipay.
 *
 * (c) Sercan Çakır <srcnckr@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mayoz\Omnipay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Omnipay facade class.
 *
 * @package   Omnipay
 * @author    Sercan Çakır <srcnckr@gmail.com>
 * @license   MIT License
 * @copyright 2015
 */
class Omnipay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'omnipay';
    }
}
