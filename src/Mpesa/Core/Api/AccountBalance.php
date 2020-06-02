<?php

namespace Snobole\Mpesa\Core\Api;

use Snobole\Mpesa\Request;
use Snobole\Mpesa\Interfaces\Mpesa;

class AccountBalance extends Request implements Mpesa
{
    /**
     * Initiate a request to check account balance
     * @param array $configParams
     * @param array $formParams
     * @return Request
     */
    public function initiateTransaction(array $configParams, array $formParams = [])
    {
        return $this->sendRequest('c2b', $formParams, $configParams);
    }

    /**
     * Receive account balance response
     * @return false|string
     */
    public function receiveTransaction()
    {
        $callbackJSONData = file_get_contents('php://input');
        $callbackData = json_decode($callbackJSONData);

        return json_encode([
            'resultType' => $callbackData->Result->ResultType,
            'resultCode' => $callbackData->Result->ResultCode,
            'resultDesc' => $callbackData->Result->ResultDesc,
            'originatorConversationID' => $callbackData->Result->OriginatorConversationID,
            'conversationID' => $callbackData->Result->ConversationID,
            'transactionID' => $callbackData->Result->TransactionID,
            'accountBalance' => $callbackData->Result->ResultParameters->ResultParameter[0]->Value,
            'BOCompletedTime' => $callbackData->Result->ResultParameters->ResultParameter[1]->Value,
        ]);
    }
}