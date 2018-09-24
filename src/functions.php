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

require_once('../config/config.php');

# Send SMS on AT

function sendMessage($to,$message,$from)
{

}

# Generate Daraja Token
function generateToken()
{
    global $daraja;

    if($daraja['ENVIRONMENT'] == "SANDBOX")
    {
        $url                       = $daraja['SANDBOX_CONFIG']['POST_URLS']['AUTHENTICATION'];
        $APP_CONSUMER_KEY          = $daraja['SANDBOX_CONFIG']['APP_CONSUMER_KEY'];
        $APP_CONSUMER_SECRET       = $daraja['SANDBOX_CONFIG']['APP_CONSUMER_SECRET'];
    }else{
        $url                       = $daraja['LIVE_CONFIG']['POST_URLS']['AUTHENTICATION'];
        $APP_CONSUMER_KEY          = $daraja['LIVE_CONFIG']['APP_CONSUMER_KEY'];
        $APP_CONSUMER_SECRET       = $daraja['LIVE_CONFIG']['APP_CONSUMER_SECRET'];
    }

    $credentials = base64_encode($APP_CONSUMER_KEY.':'.$APP_CONSUMER_SECRET);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


    $curl_response = curl_exec($curl);

    $data_response = json_decode($curl_response);

    return $data_response->access_token;
}

# Generate Security Credentials

function generateSecurityCredentials()
{
    global $daraja;

    if($daraja['ENVIRONMENT'] == "SANDBOX")
    {
        $CERT_URL                  = $daraja['SANDBOX_CONFIG']['PUBLIC_KEY'];
        $SECURITY_CREDENTIAL       = $daraja['SANDBOX_CONFIG']['SECURITY_CREDENTIAL'];
    }else{
        $CERT_URL                  = $daraja['LIVE_CONFIG']['PUBLIC_KEY'];
        $SECURITY_CREDENTIAL       = $daraja['LIVE_CONFIG']['SECURITY_CREDENTIAL'];
    }

    $publicKey = file_get_contents($CERT_URL);

    openssl_public_encrypt($SECURITY_CREDENTIAL, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

    return base64_encode($encrypted);

}

# C2B API
function c2bRegisterCallback()
{
    global $daraja;

    if($daraja['ENVIRONMENT'] == "SANDBOX")
    {
        $C2B_REGISTER_URL          = $daraja['SANDBOX_CONFIG']['POST_URLS']['C2B_REGISTER_URL'];
        $SHORTCODE                 = $daraja['SANDBOX_CONFIG']['SHORT_CODE_1'];
        $CONFIRMATION_URL          = $daraja['RESPONSE_CALLBACKS']['CONFIRMATION_URL'];
        $VALIDATION_URL            = $daraja['RESPONSE_CALLBACKS']['VALIDATION_URL'];
    }else{
        $C2B_REGISTER_URL          = $daraja['LIVE_CONFIG']['POST_URLS']['C2B_REGISTER_URL'];
        $SHORTCODE                 = $daraja['LIVE_CONFIG']['SHORT_CODE_1'];
        $CONFIRMATION_URL          = $daraja['RESPONSE_CALLBACKS']['CONFIRMATION_URL'];
        $VALIDATION_URL            = $daraja['RESPONSE_CALLBACKS']['VALIDATION_URL'];
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $C2B_REGISTER_URL);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.generateToken())); //setting custom header


    $curl_post_data = array(
    //Fill in the request parameters with valid values
    'ShortCode'       => $SHORTCODE,
    'ResponseType'    => 'json',
    'ConfirmationURL' => $CONFIRMATION_URL,
    'ValidationURL'   => $VALIDATION_URL
    );

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);

    return $curl_response;
}

# B2C API
function initiateB2C($PHONE_NUMBER, $AMOUNT, $COMMAND_ID, $DESCRIPTION)
{
    global $daraja;

    if($daraja['ENVIRONMENT'] == "SANDBOX")
    {
        $B2C_URL                   = $daraja['SANDBOX_CONFIG']['POST_URLS']['B2C'];
        $SHORTCODE                 = $daraja['SANDBOX_CONFIG']['SHORT_CODE_1'];
        $INITIATOR_NAME            = $daraja['SANDBOX_CONFIG']['INITIATOR_NAME'];
        $PHONE_NUMBER              = $daraja['SANDBOX_CONFIG']['TEST_MSISDN'];
        $CONFIRMATION_URL          = $daraja['RESPONSE_CALLBACKS']['B2C_RESULT_URL'];
        $VALIDATION_URL            = $daraja['RESPONSE_CALLBACKS']['B2C_QUEUE_TIMEOUT_URL'];
    }else{
        $B2C_URL                   = $daraja['LIVE_CONFIG']['POST_URLS']['B2C'];
        $SHORTCODE                 = $daraja['LIVE_CONFIG']['SHORT_CODE'];
        $INITIATOR_NAME            = $daraja['LIVE_CONFIG']['INITIATOR_NAME'];
        $CONFIRMATION_URL          = $daraja['RESPONSE_CALLBACKS']['B2C_RESULT_URL'];
        $VALIDATION_URL            = $daraja['RESPONSE_CALLBACKS']['B2C_QUEUE_TIMEOUT_URL'];
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $B2C_URL);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.generateToken()));


    $curl_post_data = array(
    //Fill in the request parameters with valid values
    'InitiatorName'          => $INITIATOR_NAME,
    'SecurityCredential'     => generateSecurityCredentials(),
    'CommandID'              => $COMMAND_ID,
    'Amount'                 => $AMOUNT,
    'PartyA'                 => $SHORTCODE,
    'PartyB'                 => $PHONE_NUMBER,
    'Remarks'                => $DESCRIPTION,
    'QueueTimeOutURL'        => $CONFIRMATION_URL,
    'ResultURL'              => $VALIDATION_URL,
    'Occasion'               => ''
    );

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
    return $curl_response;

}

function initiateB2B($COMMAND_ID, $SENDER_IDENTIFIER, $RECEIVER_IDENTIFIER, $AMOUNT, $TO_PAYBILL, $ACCOUNT_NO, $REMARKS)
{
    global $daraja;

    if ($daraja['ENVIRONMENT'] == "SANDBOX") 
    {
        $B2B_ENDPOINT   = $daraja['SANDBOX_CONFIG']['POST_URLS']['B2B'];
        $INITIATOR_NAME = $daraja['SANDBOX_CONFIG']['INITIATOR_NAME'];
    }
    else{
        $B2B_ENDPOINT   = $daraja['LIVE_CONFIG']['POST_URLS']['B2B'];
        $INITIATOR_NAME = $daraja['LIVE_CONFIG']['INITIATOR_NAME'];
    }

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $B2B_ENDPOINT);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.generateToken()));

    $request_data = array(
        "Initiator"               => $INITIATOR_NAME,
        "SecurityCredential"      => generateSecurityCredentials(),
        "CommandID"               => $COMMAND_ID,
        "SenderIdentifierType"    => $SENDER_IDENTIFIER,
        "RecieverIdentifierType"  => $RECEIVER_IDENTIFIER,
        "Amount"                  => $AMOUNT,
        "PartyA"                  => $daraja['LIVE_CONFIG']['SHORT_CODE'],
        "PartyB"                  => $TO_PAYBILL,
        "AccountReference"        => $ACCOUNT_NO,
        "Remarks"                 => $REMARKS,
        "QueueTimeOutURL"         => $daraja['RESPONSE_CALLBACKS']['B2B_QUEUE_TIMEOUT_URL'],
        "ResultURL"               => $daraja['RESPONSE_CALLBACKS']['B2B_RESULT_URL']
    );

    $json_data = json_encode($request_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);

    $response = curl_exec($curl);

    print_r($response);
}