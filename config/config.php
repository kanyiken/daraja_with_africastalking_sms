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
    'ACCOUNT_TYPE' => '',
    # 
    #
    # Get all sandbox credentials from https://developer.safaricom.co.ke/test_credentials, 
    # Live credentials sent to email after going live
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
        'LIPA_NA_MPESA_ONLINE_PASSKEY'   => '',
        # 
        # The URLs for sandbox are prefilled with the default ones given by Daraja
        # You dont need to change these one unless Safaricom Daraja has updated them
        #
        'URLS' => array(
            'AUTHENTICATION'             => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
            'PUBLIC_KEY'                 => $_SERVER["DOCUMENT_ROOT"] . '/cert/cert.cer',
            'C2B_REGISTER_URL'           => 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl',
            '' => '',
            '' => ''
        ),
    ),
);

$africastalking = array(
    # This is the API to handle SMS confirmation for payments to and from the Daraja API
    # Website www.africastalking.com
    # 
    'APP_USERNAME'                       => '', # Africa's Talking Username
    'APP_API_KEY'                        => '', # Africa's Talking API Key
    'SENDER_ID'                          => ''  # Africa's Talking Sender ID, Default is Africa's Talking
);
