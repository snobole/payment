<?php
return [
    'environment' => 'sandbox',
    'sandbox' => [
        'urls' => [
            'token' => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
            'c2b' => 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate',
            'b2c' => 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest',
            'b2b' => 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest',
            'account_balance' => 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query',
            'reversal' => 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request',
            'transaction_status' => 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query',
            'stk_push' => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
            'stk_push_query' => 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query',
        ],
        'consumer_key' => '',
        'consumer_secret' => '',
        'shortcode' => '',
    ],
    'live' => [
        'urls' => [
            'token' => 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
            'c2b' => 'https://api.safaricom.co.ke/mpesa/c2b/v1/simulate',
            'b2c' => 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest',
            'b2b' => 'https://api.safaricom.co.ke/mpesa/b2b/v1/paymentrequest',
            'reversal' => 'https://api.safaricom.co.ke/mpesa/reversal/v1/request',
            'account_balance' => 'https://api.safaricom.co.ke/mpesa/accountbalance/v1/query',
            'transaction_status' => 'https://api.safaricom.co.ke/mpesa/transactionstatus/v1/query',
            'stk_push' => 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
            'stk_push_query' => 'https://api.safaricom.co.ke/mpesa/stkpushquery/v1/query',
        ],
        'consumer_key' => '',
        'consumer_secret' => '',
        'shortcode' => '',
    ]
];
