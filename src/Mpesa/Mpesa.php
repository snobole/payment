<?php

namespace Snobole\Mpesa;

use Snobole\Mpesa\Core\Api\AccountBalance;
use Snobole\Mpesa\Core\Api\B2B;
use Snobole\Mpesa\Core\Api\B2C;
use Snobole\Mpesa\Core\Api\C2B;
use Snobole\Mpesa\Core\Api\Reversal;
use Snobole\Mpesa\Core\Api\STKPush;
use Snobole\Mpesa\Core\Api\STKPushQuery;
use Snobole\Mpesa\Core\Api\TransactionStatus;

class Mpesa
{
    public function initiateApi(string $api)
    {

        switch (strtoupper($api)) {
            case 'C2B':
                return new C2B();
            case 'B2C':
                return new B2C();
            case 'B2B':
                return new B2B();
            case 'ACCOUNT_BALANCE':
                return new AccountBalance();
            case 'REVERSAL':
                return new Reversal();
            case 'TRANSACTION_STATUS':
                return new TransactionStatus();
            case 'STK_PUSH':
                return new STKPush();
            case 'STK_PUSH_QUERY':
                return new STKPushQuery();
            default:
                throw new \InvalidArgumentException('Unsupported mpesa api: ' . $api);
        }
    }
}