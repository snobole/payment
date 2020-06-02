<?php

namespace Snobole;

use Snobole\Mpesa\Mpesa;
use Snobole\Services\Validator;

class Payment
{
    /**
     * @param $paymentMethod
     * @return Mpesa
     */
    public function initializePayment($paymentMethod)
    {
        Validator::validatePaymentMethod($paymentMethod);

        if (strtoupper($paymentMethod) == 'MPESA') {
            return new Mpesa();
        }

        throw new \InvalidArgumentException('Unsupported payment method: ' . $paymentMethod);
    }
}