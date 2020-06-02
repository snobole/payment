<?php

namespace Snobole\Mpesa\Core\Api;

use Snobole\Mpesa\Request;
use Snobole\Mpesa\Interfaces\Mpesa;

class B2B extends Request implements Mpesa
{
    /**
     * Initialize a business to business transaction
     * @param array $configParams
     * @param array $formParams
     * @return Request
     */
    public function initiateTransaction(array $configParams, array $formParams = [])
    {
        return $this->sendRequest('b2b', $formParams, $configParams);
    }

    /**
     * Receive business to business transaction
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
            'transactionReceipt' => $callbackData->Result->ResultParameters->ResultParameter[0]->Value,
            'transactionAmount' => $callbackData->Result->ResultParameters->ResultParameter[1]->Value,
            'b2CWorkingAccountAvailableFunds' => $callbackData->Result->ResultParameters->ResultParameter[2]->Value,
            'b2CUtilityAccountAvailableFunds' => $callbackData->Result->ResultParameters->ResultParameter[3]->Value,
            'transactionCompletedDateTime' => $callbackData->Result->ResultParameters->ResultParameter[4]->Value,
            'receiverPartyPublicName' => $callbackData->Result->ResultParameters->ResultParameter[5]->Value,
            'B2CChargesPaidAccountAvailableFunds' => $callbackData->Result->ResultParameters->ResultParameter[6]->Value,
            'B2CRecipientIsRegisteredCustomer' => $callbackData->Result->ResultParameters->ResultParameter[7]->Value,
        ]);
    }
}