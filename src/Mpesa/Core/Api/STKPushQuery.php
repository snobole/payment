<?php

namespace Snobole\Mpesa\Core\Api;

use Snobole\Mpesa\Request;
use Snobole\Mpesa\Interfaces\Mpesa;

class STKPushQuery extends Request implements Mpesa
{
    /**
     * Initiate an stk push query transaction
     * @param array $configParams
     * @param array $formParams
     * @return Request
     */
    public function initiateTransaction(array $configParams, array $formParams = [])
    {
        return $this->sendRequest('stk_push', $formParams, $configParams);
    }

    /**
     * Receive an stk push query transaction response
     * @return false|string
     */
    public function receiveTransaction()
    {
        $callbackJSONData = file_get_contents('php://input');
        $callbackData = json_decode($callbackJSONData);

        return json_encode([
            'resultCode' => $callbackData->Body->stkCallback->ResultCode,
            'resultDesc' => $callbackData->Body->stkCallback->ResultDesc,
            'merchantRequestID' => $callbackData->Body->stkCallback->MerchantRequestID,
            'checkoutRequestID' => $callbackData->Body->stkCallback->CheckoutRequestID,
            'amount' => $callbackData->stkCallback->Body->CallbackMetadata->Item[0]->Value,
            'mpesaReceiptNumber' => $callbackData->Body->stkCallback->CallbackMetadata->Item[1]->Value,
            'balance' => $callbackData->stkCallback->Body->CallbackMetadata->Item[2]->Value,
            'b2CUtilityAccountAvailableFunds' => $callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value,
            'transactionDate' => $callbackData->Body->stkCallback->CallbackMetadata->Item[4]->Value,
            'phoneNumber' => $callbackData->Body->stkCallback->CallbackMetadata->Item[5]->Value,
        ]);
    }
}