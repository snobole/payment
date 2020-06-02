<?php


namespace Snobole\Mpesa\Interfaces;


interface Mpesa
{
    public function initiateTransaction(array $configParams, array $formParams = []);
    public function receiveTransaction();
}