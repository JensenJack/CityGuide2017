<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Booking Payment For Paypal,MPU,123,True Money,Bank Transfer,Deposit
    |--------------------------------------------------------------------------e
    |
    */
   'paylater' => array(
           'enable' => env('PAYLATER_ENABLE', ''),
           'expiry' => env('PAYLATER_EXPIRY', ''),
           'charge_type' => env('PAYLATER_CHARGE_TYPE', ''),
           'charge' => env('PAYLATER_CHARGE', ''),
        ),

    'ok' => array(
           'enable' => env('OK_ENABLE', ''),
           'apikey' => env('OK_APIKEY', ''),
           'destination' => env('OK_DESTINATION', ''),
           'merchant_name' => env('OK_MERCHANT_NAME', ''),
           'url' => env('OK_PAYMENT_URL', ''),
           'frontend_url' => env('OK_FRONTEND_URL', ''),
           'charge_type' => env('OK_CHARGE_TYPE', ''),
           'charge' => env('OK_CHARGE', ''),
        ),

    'paypal' => array(
    		   'enable' => env('PAYPAL_ENABLE', ''),
           'payment_url' => env('PAYPAL_PAYMENT_URL', ''),
    		   'email' => env('PAYPAL_EMAIL', ''),
    		   'charge_type' => env('PAYPAL_CHARGE_TYPE', ''),
    		   'charge' => env('PAYPAL_CHARGE', ''),
    		),
    'mpu'   => array(
               'enable' => env('MPU_ENABLE', ''),
               'version' => env('MPU_VERSION', ''),
               'hash_key' => env('MPU_HASH_KEY', ''),
               'merchant_id' => env('MPU_MERCHANT_ID', ''),
               'frontend_url' => env('MPU_FRONTEND_URL', ''),
               'backend_url' => env('MPU_BACKEND_URL', ''),
               'payment_url' => env('MPU_PAYMENT_URL', ''),
               'charge_type' => env('MPU_CHARGE_TYPE', ''),
               'charge' => env('MPU_CHARGE', ''),
            ),
    'transfer'   => array(
    		   'enable' => env('TRANSFER_ENABLE', ''),
    		   'transfer_1' => env('TRANSFER_1', ''),
           'transfer_2' => env('TRANSFER_2', ''),
           'transfer_3' => env('TRANSFER_3', ''),
           'transfer_4' => env('TRANSFER_4', ''),
           'transfer_5' => env('TRANSFER_5', ''),
           'transfer_6' => env('TRANSFER_6', ''),
           'transfer_7' => env('TRANSFER_7', ''),
           'transfer_8' => env('TRANSFER_8', ''),
           'transfer_9' => env('TRANSFER_9', ''),
    		   'transfer_10' => env('TRANSFER_10', ''),
    		   'charge_type' => env('TRANSFER_CHARGE_TYPE', ''),
    		   'charge' => env('TRANSFER_CHARGE', ''),
    		),
    'onetwothree'   => array(
               'enable' => env('ONETWOTHREE_ENABLE', ''),
               'MerchantID' => env('ONETWOTHREE_MERCHANTID', ''),
               'Merchantpassword' => env('ONETWOTHREE_MERCHANTPASSWORD', ''),
               'Version' => env('ONETWOTHREE_VERSION', ''),
               'CurrencyCode' => env('ONETWOTHREE_CURRENCYCODE', ''),
               'CountryCode' => env('ONETWOTHREE_COUNTRYCODE', ''),
               'AgentCode' => env('ONETWOTHREE_AGENTCODE', ''),
               'ChannelCode' => env('ONETWOTHREE_CHANNELCODE', ''),
               'ApiKey' => env('ONETWOTHREE_APIKEY', ''),
               'Url' => env('ONETWOTHREE_URL', ''),
               'charge_type' => env('ONETWOTHREE_CHARGE_TYPE', ''),
               'charge' => env('ONETWOTHREE_CHARGE', ''),
            ),
    'visa_master'   => array(
               'enable' => env('VISA_MASTER_ENABLE', ''),
               'version' => env('VISA_MASTER_VERSION', ''),
               'currency' => env('VISA_MASTER_CURRENCY', ''),
               'hash_key' => env('VISA_MASTER_HASH_KEY', ''),
               'merchant_id' => env('VISA_MASTER_MERCHANT_ID', ''),
               'frontend_url' => env('VISA_MASTER_FRONTEND_URL', ''),
               'backend_url' => env('VISA_MASTER_BACKEND_URL', ''),
               'payment_url' => env('VISA_MASTER_PAYMENT_URL', ''),
               'charge_type' => env('VISA_MASTER_CHARGE_TYPE', ''),
               'charge' => env('VISA_MASTER_CHARGE', ''),
            ),
    'mab'   => array(
           'enable' => env('MAB_ENABLE', ''),
           'MID' => env('MAB_MID', ''),
           'ShareKey' => env('MAB_SHAREKEY', ''),
           'MName' => env('MAB_MNAME', ''),
           'url' => env('MAB_URL', ''),
           'frontend_url' => env('MAB_FRONTEND_URL', ''),
    		   'act_url' => env('MAB_ACT_URL', ''),
    		   'charge_type' => env('MAB_CHARGE_TYPE', ''),
    		   'charge' => env('MAB_CHARGE', ''),
    		),
    'truemoney'   => array(
    		   'enable' => env('TRUE_ENABLE', ''),
           'hash_key' => env('TRUE_HASH_KEY', ''),
           'merchant_id' => env('TRUE_MERCHANT_ID', ''),
           'url' => env('TRUE_PAYMENT_URL', ''),
           'backend_url' => env('TRUE_BACKEND_URL', ''),
    		   'charge_type' => env('TRUE_CHARGE_TYPE', ''),
    		   'charge' => env('TRUE_CHARGE', ''),
    		),
    'deposite'   => array(
    		   'enable' => env('DEPOSITE_ENABLE', ''),
    		   'charge_type' => env('DEPOSITE_CHARGE_TYPE', ''),
    		   'charge' => env('DEPOSITE_CHARGE', ''),
    		),
];