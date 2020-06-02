<?php

namespace Snobole;

use Snobole\Mpesa\Core\Request as MpesaRequest;
use Snobole\Services\Validator;

class Request
{
    /**
     * @param $paymentMethod
     * @return MpesaRequest
     */
    public function initializeRequest($paymentMethod)
    {
        Validator::validatePaymentMethod($paymentMethod);

        if (strtoupper($paymentMethod) == 'MPESA') {
            return new MpesaRequest();
        }

        throw new \InvalidArgumentException('Unsupported payment method: ' . $paymentMethod);
    }
}