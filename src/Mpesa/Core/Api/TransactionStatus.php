<?php

namespace Snobole\Mpesa\Core\Api;

use Snobole\Mpesa\Request;
use Snobole\Mpesa\Interfaces\Mpesa;

class TransactionStatus extends Request implements Mpesa
{
    /**
     * Initiate a transaction status query
     * @param array $configParams
     * @param array $formParams
     * @return Request
     */
    public function initiateTransaction(array $configParams, array $formParams = [])
    {
        return $this->sendRequest('transaction_status', $formParams, $configParams);
    }

    /**
     * Receive a transaction status query response
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
            'ReceiptNo' => $callbackData->Result->ResultParameters->ResultParameter[0]->Value,
            'ConversationID' => $callbackData->Result->ResultParameters->ResultParameter[1]->Value,
            'FinalisedTime' => $callbackData->Result->ResultParameters->ResultParameter[2]->Value,
            'Amount' => $callbackData->Result->ResultParameters->ResultParameter[3]->Value,
            'TransactionStatus' => $callbackData->Result->ResultParameters->ResultParameter[4]->Value,
            'ReasonType' => $callbackData->Result->ResultParameters->ResultParameter[5]->Value,
            'TransactionReason' => $callbackData->Result->ResultParameters->ResultParameter[6]->Value,
            'DebitPartyCharges' => $callbackData->Result->ResultParameters->ResultParameter[7]->Value,
            'DebitAccountType' => $callbackData->Result->ResultParameters->ResultParameter[8]->Value,
            'InitiatedTime' => $callbackData->Result->ResultParameters->ResultParameter[9]->Value,
            'OriginatorConversationID' => $callbackData->Result->ResultParameters->ResultParameter[10]->Value,
            'CreditPartyName' => $callbackData->Result->ResultParameters->ResultParameter[11]->Value,
            'DebitPartyName' => $callbackData->Result->ResultParameters->ResultParameter[12]->Value,
        ]);
    }
}