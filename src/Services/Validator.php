<?php
namespace Snobole\Services;

class Validator
{

    static $paymentMethods = [
        'MPESA',
    ];

    public static function validatePaymentMethod($paymentMethod)
    {
        if (!in_array(strtoupper($paymentMethod), self::$paymentMethods))
            throw new \InvalidArgumentException('The Specified payment method is not supported yet');
    }
}