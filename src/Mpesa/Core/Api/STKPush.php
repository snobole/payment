<?php

namespace Snobole\Mpesa\Core\Api;

use Snobole\Mpesa\Request;
use Snobole\Mpesa\Interfaces\Mpesa;

class STKPush extends Request implements Mpesa
{
    /**
     * Initiate an stk push transaction
     * @param array $configParams
     * @param array $formParams
     * @return Request
     */
    public function initiateTransaction(array $configParams, array $formParams = [])
    {
        return $this->sendRequest('stk_push', $formParams, $configParams);
    }

    /**
     * Receive an stk push transaction response
     * @return false|string
     */
    public function receiveTransaction()
    {
        $callbackJSONData = file_get_contents('php://input');
        $callbackData = json_decode($callbackJSONData);

        return json_encode([
            'responseCode' => $callbackData->ResponseCode,
            'responseDescription' => $callbackData->ResponseDescription,
            'merchantRequestID' => $callbackData->MerchantRequestID,
            'checkoutRequestID' => $callbackData->CheckoutRequestID,
            'resultCode' => $callbackData->ResultCode,
            'resultDesc' => $callbackData->ResultDesc,
        ]);
    }
}