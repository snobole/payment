<?php

namespace Snobole\Mpesa\Core\Api;

use Snobole\Mpesa\Request;
use Snobole\Mpesa\Interfaces\Mpesa;

class Reversal extends Request implements Mpesa
{
    /**
     * Initiate a reversal transaction
     * @param array $configParams
     * @param array $formParams
     * @return Request
     */
    public function initiateTransaction(array $configParams, array $formParams = [])
    {
        return $this->sendRequest('c2b', $formParams, $configParams);
    }

    /**
     * Receive a reversal request response
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
        ]);
    }
}