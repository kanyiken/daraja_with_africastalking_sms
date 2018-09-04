<?php
/**
 * Daraja with Africa's Talking SMS confirmation
 *
 * This is an open source and simplified implementation of Daraja API and Africa's Talking SMS APIs
 *
 * @author Kanyi K <kanyikennedy@gmail.com>
 * @author Vincent Muchiri <vgichira39@gmail.com>
 * @license http://www.opensource.org/licenses/MIT
 * 
 */


$daraja = array(
    # Define if you are on Sandbox or Live
    # Value should be SANDBOX or LIVE
    # Default Value is SANDBOX
    # 
    'ENVIRONMENT' => 'SANDBOX',
    # 
    #
    # Get all sandbox credentials from https://developer.safaricom.co.ke/test_credentials, 
    #
    'SANDBOX_CONFIG' => array(
        'APP_CONSUMER_KEY'               => 'pyhfLWi17bMPs3gchEnEAY2wb6S9Wj9n', # Daraja Consumer Key 
        'APP_CONSUMER_SECRET'            => 'VCORc4rrhPGP3SRj', # Daraja Consumer Secret 
        'SHORT_CODE_1'                   => '600733', # Daraja Test Shortcode 1 
        'SHORT_CODE_2'                   => '600000', # Daraja Test Shortcode 2 
        'COMMAND_ID'                     => 'CustomerPayBillOnline', #The command ID. Possible values (CustomerPayBillOnline (For Paybill number), CustomerBuyGoodsOnline (For Till number))
        'INITIATOR_NAME'                 => 'Safaricomapi', # Daraja Initiator Name (Shortcode 1)
        'TEST_MSISDN'                    => '254708374149', # Daraja Test Test MSISDN 
        'SECURITY_CREDENTIAL'            => 'fP6K2KuL', # Daraja Security Credential (Shortcode 1)
        'LIPA_NA_MPESA_ONLINE_SHORTCODE' => '174379', # Daraja Lipa Na Mpesa Online Shortcode
        'LIPA_NA_MPESA_ONLINE_PASSKEY'   => 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919', # Daraja Lipa Na Mpesa Online Passkey
        'PUBLIC_KEY'                     => $_SERVER["DOCUMENT_ROOT"] . '/daraja/cert/sandbox_cert.cer', # Sandbox certificate location (Can either be sandbox or live MPESA cert. Use sandbox cert when testing in sandbox)
        # 
        # The URLs for sandbox are prefilled with the default ones given by Daraja
        # You dont need to change these one unless Safaricom Daraja has updated them
        #
        'POST_URLS' => array(
            'AUTHENTICATION'             => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
            'SIMULATE_C2B'               => 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate',
            'C2B_REGISTER_URL'           => 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl',
            'B2C'                        => 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest',
            'B2B'                        => 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest',
            'ACCOUNT_BALANCE'            => 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query',
            'REVERSAL'                   => 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request',
            'CHECKOUT'                   => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
        )
    ),
    #
    # These credentials will be sent once you submit the test cases and Go Live 
    #
    'LIVE_CONFIG' => array(
        'APP_CONSUMER_KEY'               => '', # Live Consumer Key 
        'APP_CONSUMER_SECRET'            => '', # Live Consumer Secret 
        'SHORT_CODE'                     => '', # Your Paybill Number
        'INITIATOR_NAME'                 => '', # Initiator Name / Operator
        'SECURITY_CREDENTIAL'            => '', # Security Credential (Shortcode 1)
        'LIPA_NA_MPESA_ONLINE_PASSKEY'   => '', 
        # 
        # These URLS will be sent to your email once you submit the test cases
        #
        'POST_URLS' => array(
            'AUTHENTICATION'             => '',
            'PUBLIC_KEY'                 => '',
            'C2B_REGISTER_URL'           => '',
            'B2C'                        => '',
            'B2B'                        => '',
            'ACCOUNT_BALANCE'            => '',
            'REVERSAL'                   => '',
            'CHECKOUT'                   => ''
        )
    ),
    #
    # These are the callbacks that Safaricom will post the request responses to...
    # The callbacks defined here will cater for the SANDBOX and LIVE environments
    # Daraja sends back JSON data that we process in the callbacks folder
    #
    'RESPONSE_CALLBACKS' => array(
        #
        # C2B Callbacks. The register URL happens only once
        #
        'CONFIRMATION_URL'                  => 'https://oneplace.ngrok.io/daraja/config/confirm/',
        'VALIDATION_URL'                    => 'https://oneplace.ngrok.io/daraja/config/validate/',
        #
        # B2C Callbacks
        #
        'B2C_RESULT_URL'                    => 'https://oneplace.ngrok.io/daraja/config/confirm/',
        'B2C_QUEUE_TIMEOUT_URL'             => 'https://oneplace.ngrok.io/daraja/config/validate/',
        #
        # B2B Callbacks
        #
        'B2B_RESULT_URL'                    => 'https://oneplace.ngrok.io/daraja/config/b2bnotifs/',
        'B2B_QUEUE_TIMEOUT_URL'             => 'https://oneplace.ngrok.io/daraja/config/b2btimeout/',
        #
        # Account Balance Callbacks
        #
        'BALANCE_RESULT_URL'                => '',
        'BALANCE_QUEUE_TIMEOUT_URL'         => '',
        #
        # Transaction Status Callbacks
        #
        'TRANSACTION_STATUS_RESULT_URL'     => '',
        'TRANSACTION_STATUS_TIMEOUT_URL'    => '',
        #
        # Reversal Callbacks
        #
        'REVERSAL_RESULT_URL'               => '',
        'REVERSAL_TIMEOUT_URL'              => '',
        #
        # Checkout Callbacks
        #
        'CHECKOUT_RESULT_URL'               => 'https://callmevincent.com/daraja/checkout/'
    )
);

$africastalking = array(
    # This is the API to handle SMS confirmation for payments to and from the Daraja API
    # Website www.africastalking.com
    #

    "ENVIRONMENT" => "SANDBOX", # Can either be LIVE OR SANDBOX. Default is SANDBOX

    "SANDBOX"=>array(
        'APP_USERNAME'                          => 'sandbox', # Africa's Talking Sandbox Username.
        'APP_API_KEY'                           => 'ad8f74a9eef2490fe5b2c52e6eaf47707b43af36dc141b2474d40aa3177b946e', # Africa's Talking Sandbox API Key
        'SENDER_ID'                             =>  NULL,  # Africa's Talking Sender ID, Default is Africa's Talking
    ),

    "LIVE"=>array(
        'APP_USERNAME'                          => 'AFRICASTALKING_USERNAME', # Africa's Talking Username
        'APP_API_KEY'                           => 'AFRICASTALKING_API_KEY', # Africa's Talking API Key
        'SENDER_ID'                             => 'CUSTOM_SENDER ID',  # Africa's Talking Sender ID, Default is Africa's Talking
    )
);
