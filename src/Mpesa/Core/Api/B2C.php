<?php

namespace Snobole\Mpesa\Core\Api;

use Snobole\Mpesa\Request;
use Snobole\Mpesa\Interfaces\Mpesa;

class B2C extends Request implements Mpesa
{
    /**
     * Initiate a business to customer transaction
     * @param array $configParams
     * @param array $formParams
     * @return Request
     */
    public function initiateTransaction(array $configParams, array $formParams = [])
    {
        return $this->sendRequest('b2c', $formParams, $configParams);
    }
    /**
     * Receive business to customer transaction
     * @return false|string
     */
    public function receiveTransaction()
    {
        $callbackJSONData = file_get_contents('php://input');
        $callbackData = json_decode($callbackJSONData);

        return json_encode([
            'resultCode' => $callbackData->Result->ResultCode,
            'resultDesc' => $callbackData->Result->ResultDesc,
            'originatorConversationID' => $callbackData->Result->OriginatorConversationID,
            'conversationID' => $callbackData->Result->ConversationID,
            'transactionID' => $callbackData->Result->TransactionID,
            'initiatorAccountCurrentBalance' => $callbackData->Result->ResultParameters->ResultParameter[0]->Value,
            'debitAccountCurrentBalance' => $callbackData->Result->ResultParameters->ResultParameter[1]->Value,
            'amount' => $callbackData->Result->ResultParameters->ResultParameter[2]->Value,
            'debitPartyAffectedAccountBalance' => $callbackData->Result->ResultParameters->ResultParameter[3]->Value,
            'transCompletedTime' => $callbackData->Result->ResultParameters->ResultParameter[4]->Value,
            'debitPartyCharges' => $callbackData->Result->ResultParameters->ResultParameter[5]->Value,
            'receiverPartyPublicName' => $callbackData->Result->ResultParameters->ResultParameter[6]->Value,
            'currency' => $callbackData->Result->ResultParameters->ResultParameter[7]->Value,
        ]);
    }
}