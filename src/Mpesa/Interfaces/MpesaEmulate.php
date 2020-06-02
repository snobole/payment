<?php


namespace Snobole\Mpesa\Support\Core;


interface MpesaEmulate
{
    /**
     * Register validation and confirmation Endpoints
     * @return mixed
     */
    public function registerEndpoints();

    /**
     * Initiate a reversal
     * @return mixed
     */
    public function initiateReversal();

    /**
     * @param $InitiatorName | 	This is the credential/username used to authenticate the transaction request.
     * @param $SecurityCredential | Encrypted password for the initiator to authenticate the transaction request
     * @param $CommandID | Unique command for each transaction type e.g. SalaryPayment, BusinessPayment, PromotionPayment
     * @param $Amount | The amount being transacted
     * @param $PartyA | Organization’s shortcode initiating the transaction.
     * @param $PartyB | Phone number receiving the transaction
     * @param $Remarks | Comments that are sent along with the transaction.
     * @param $QueueTimeOutURL | The timeout end-point that receives a timeout response.
     * @param $ResultURL | The end-point that receives the response of the transaction
     * @param $Occasion | 	Optional
     * @return string
     */
    public function initiateB2C($InitiatorName, $SecurityCredential, $CommandID, $Amount, $PartyA, $PartyB, $Remarks, $QueueTimeOutURL, $ResultURL, $Occasion);


    /**
     * Use this function to initiate a C2B transaction
     * @param $ShortCode | 6 digit M-Pesa Till Number or PayBill Number
     * @param $CommandID | Unique command for each transaction type.
     * @param $Amount | The amount been transacted.
     * @param $Msisdn | MSISDN (phone number) sending the transaction, start with country code without the plus(+) sign.
     * @param $BillRefNumber | 	Bill Reference Number (Optional).
     * @return mixed|string
     */
    public function initiateC2B($ShortCode, $CommandID, $Amount, $Msisdn, $BillRefNumber );

    /**
     * Use this to initiate a balance inquiry request
     * @param $CommandID | A unique command passed to the M-Pesa system.
     * @param $Initiator | 	This is the credential/username used to authenticate the transaction request.
     * @param $SecurityCredential | Encrypted password for the initiator to autheticate the transaction request
     * @param $PartyA | Type of organization receiving the transaction
     * @param $IdentifierType |Type of organization receiving the transaction
     * @param $Remarks | Comments that are sent along with the transaction.
     * @param $QueueTimeOutURL | The path that stores information of time out transaction
     * @param $ResultURL | 	The path that stores information of transaction
     * @return mixed|string
     */
    public function checkAccountBalance($CommandID, $Initiator, $SecurityCredential, $PartyA, $IdentifierType, $Remarks, $QueueTimeOutURL, $ResultURL);

    /**
     * Use this function to make a transaction status request
     * @param $Initiator | The name of Initiator to initiating the request.
     * @param $SecurityCredential | 	Encrypted password for the initiator to autheticate the transaction request.
     * @param $CommandID | Unique command for each transaction type, possible values are: TransactionStatusQuery.
     * @param $TransactionID | Organization Receiving the funds.
     * @param $PartyA | Organization/MSISDN sending the transaction
     * @param $IdentifierType | Type of organization receiving the transaction
     * @param $ResultURL | The path that stores information of transaction
     * @param $QueueTimeOutURL | The path that stores information of time out transaction
     * @param $Remarks | 	Comments that are sent along with the transaction
     * @param $Occasion | 	Optional Parameter
     * @return mixed|string
     */
    public function checkTransactionStatus($Initiator, $SecurityCredential, $CommandID, $TransactionID, $PartyA, $IdentifierType, $ResultURL, $QueueTimeOutURL, $Remarks, $Occasion);

    /**
     * Use this function to initiate a B2B request
     * @param $Initiator | This is the credential/username used to authenticate the transaction request.
     * @param $SecurityCredential | Encrypted password for the initiator to autheticate the transaction request.
     * @param $Amount | Base64 encoded string of the B2B short code and password, which is encrypted using M-Pesa public key and validates the transaction on M-Pesa Interfaces system.
     * @param $PartyA | Organization’s short code initiating the transaction.
     * @param $PartyB | Organization’s short code receiving the funds being transacted.
     * @param $Remarks | Comments that are sent along with the transaction.
     * @param $QueueTimeOutURL | The path that stores information of time out transactions.it should be properly validated to make sure that it contains the port, URI and domain name or publicly available IP.
     * @param $ResultURL | The path that receives results from M-Pesa it should be properly validated to make sure that it contains the port, URI and domain name or publicly available IP.
     * @param $AccountReference | Account Reference mandatory for “BusinessPaybill” CommandID.
     * @param $commandID | Unique command for each transaction type, possible values are: BusinessPayBill, MerchantToMerchantTransfer, MerchantTransferFromMerchantToWorking, MerchantServicesMMFAccountTransfer, AgencyFloatAdvance
     * @param $SenderIdentifierType | Type of organization sending the transaction.
     * @param $ReceiverIdentifierType | Type of organization receiving the funds being transacted.
     * @return mixed|string
     */

    public function initiateB2B($Initiator, $SecurityCredential, $Amount, $PartyA, $PartyB, $Remarks, $QueueTimeOutURL, $ResultURL, $AccountReference, $commandID, $SenderIdentifierType, $ReceiverIdentifierType);

    /**
     * Use this function to initiate an STKPush Simulation
     * @param $BusinessShortCode | The organization shortcode used to receive the transaction.
     * @param $LipaNaMpesaPasskey | The password for encrypting the request. This is generated by base64 encoding BusinessShortcode, Passkey and Timestamp.
     * @param $TransactionType | The transaction type to be used for this request. Only CustomerPayBillOnline is supported.
     * @param $Amount | The amount to be transacted.
     * @param $PartyA | The MSISDN sending the funds.
     * @param $PartyB | The organization shortcode receiving the funds
     * @param $PhoneNumber | The MSISDN sending the funds.
     * @param $CallBackURL | The url to where responses from M-Pesa will be sent to.
     * @param $AccountReference | Used with M-Pesa PayBills.
     * @param $TransactionDesc | A description of the transaction.
     * @param $Remark | Remarks
     * @return mixed|string
     */
    public function initiateSTKPush($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remark);

    /**
     * Use this function to initiate an STKPush Status Query request.
     * @param $checkoutRequestID | Checkout RequestID
     * @param $businessShortCode | Business Short Code
     * @param $password | Password
     * @param $timestamp | Timestamp
     * @return mixed|string
     */
    public function initiateSTKPushQuery($checkoutRequestID, $businessShortCode, $password, $timestamp);
}