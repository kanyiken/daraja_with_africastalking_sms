<?php
/**
 * Daraja with Africa's Talking SMS confirmation
 *
 * This is an open source and simplified implementation of Daraja API and Africa's Talking SMS APIs
 *
 * @author Kanyi K <kanyikennedy@gmail.com>
 * @license http://www.opensource.org/licenses/MIT
 * 
 */


$daraja = array(
    # Define if you are on Sandbox or Live
    # Value should be SANDBOX or LIVE
    # Default Value is SANDBOX
    # 
    'ENVIRONMENT' => 'LIVE',
    # 
    #
    # Get all sandbox credentials from https://developer.safaricom.co.ke/test_credentials, 
    #
    'SANDBOX_CONFIG' => array(
        'APP_CONSUMER_KEY'               => '', # Daraja Consumer Key 
        'APP_CONSUMER_SECRET'            => '', # Daraja Consumer Secret 
        'SHORT_CODE_1'                   => '', # Daraja Test Shortcode 1 
        'SHORT_CODE_2'                   => '', # Daraja Test Shortcode 2 
        'INITIATOR_NAME'                 => '', # Daraja Initiator Name (Shortcode 1)
        'TEST_MSISDN'                    => '', # Daraja Test Test MSISDN 
        'SECURITY_CREDENTIAL'            => '', # Daraja Security Credential (Shortcode 1)
        'LIPA_NA_MPESA_ONLINE_SHORTCODE' => '', # Daraja Lipa Na Mpesa Online Shortcode
        'LIPA_NA_MPESA_ONLINE_PASSKEY'   => '', # Daraja Lipa Na Mpesa Online Passkey
        'PUBLIC_KEY'                     => $_SERVER["DOCUMENT_ROOT"] . '/daraja_with_africastalking_sms/cert/sandbox_cert.cer', # Sandbox certificate location
        # 
        # The URLs for sandbox are prefilled with the default ones given by Daraja
        # You dont need to change these one unless Safaricom Daraja has updated them
        #
        'POST_URLS' => array(
            'AUTHENTICATION'             => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
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
        'SECURITY_CREDENTIAL'            => '', # Security Credential 
        'LIPA_NA_MPESA_ONLINE_PASSKEY'   => '', 
        'PUBLIC_KEY'                     => $_SERVER["DOCUMENT_ROOT"] . '/daraja_with_africastalking_sms/cert/live_cert.cer', 
        # 
        # These URLS will be sent to your email once you submit the test cases
        #
        'POST_URLS' => array(
            'AUTHENTICATION'             => 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',            
            'C2B_REGISTER_URL'           => '',
            'B2C'                        => 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest',
            'B2B'                        => 'https://api.safaricom.co.ke/mpesa/b2b/v1/paymentrequest',
            'ACCOUNT_BALANCE'            => 'https://api.safaricom.co.ke/mpesa/accountbalance/v1/query',
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
        'CONFIRMATION_URL'                  => 'https://amisend.ngrok.io/daraja',
        'VALIDATION_URL'                    => 'https://amisend.ngrok.io/daraja',
        #
        # B2C Callbacks
        #
        'B2C_RESULT_URL'                    => 'https://amisend.ngrok.io/daraja',
        'B2C_QUEUE_TIMEOUT_URL'             => 'https://amisend.ngrok.io/daraja',
        #
        # B2B Callbacks
        #
        'B2B_RESULT_URL'                    => 'https://amisend.ngrok.io/daraja',
        'B2B_QUEUE_TIMEOUT_URL'             => 'https://amisend.ngrok.io/daraja',
        #
        # Account Balance Callbacks
        #
        'BALANCE_RESULT_URL'                => 'https://amisend.ngrok.io/daraja',
        'BALANCE_QUEUE_TIMEOUT_URL'         => 'https://amisend.ngrok.io/daraja',
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
        'CHECKOUT_RESULT_URL'               => ''
    )
);

$africastalking = array(
    # This is the API to handle SMS confirmation for payments to and from the Daraja API
    # Website www.africastalking.com
    # 
    'APP_USERNAME'                          => '', # Africa's Talking Username
    'APP_API_KEY'                           => '', # Africa's Talking API Key
    'SENDER_ID'                             => ''  # Africa's Talking Sender ID, Default is Africa's Talking
);
