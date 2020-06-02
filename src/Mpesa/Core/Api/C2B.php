<?php

namespace Snobole\Mpesa\Core\Api;

use Snobole\Mpesa\Request;
use Snobole\Mpesa\Interfaces\Mpesa;

class C2B extends Request implements Mpesa
{
    /**
     * Initiate a customer to business transaction
     * @param array $configParams
     * @param array $formParams
     * @return Request
     */
    public function initiateTransaction(array $configParams, array $formParams = [])
    {
        return $this->sendRequest('c2b', $formParams, $configParams);
    }

    /**
     * Receive customer to business transaction
     * @return false|string
     */
    public function receiveTransaction()
    {
        $callbackJSONData = file_get_contents('php://input');
        $callbackData = json_decode($callbackJSONData);

        return json_encode([
            'transactionType' => $callbackData->TransactionType,
            'transID' => $callbackData->TransID,
            'transTime' => $callbackData->TransTime,
            'transAmount' => $callbackData->TransAmount,
            'businessShortCode' => $callbackData->BusinessShortCode,
            'billRefNumber' => $callbackData->BillRefNumber,
            'invoiceNumber' => $callbackData->InvoiceNumber,
            'orgAccountBalance' => $callbackData->OrgAccountBalance,
            'thirdPartyTransID' => $callbackData->ThirdPartyTransID,
            'MSISDN' => $callbackData->MSISDN,
            'firstName' => $callbackData->FirstName,
            'middleName' => $callbackData->MiddleName,
            'lastName' => $callbackData->LastName,
        ]);
    }
}