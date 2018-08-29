<?php
$url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer pAOavwSkw2Psluck5xUmHJITGfAY')); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'CommandID' => time(),
  'Initiator' => 'apitest466',
  'SecurityCredential' => 'VBVRgJFOTQx7gp7lsSiygsa17AMHqSjS7N50imccB8x7iiFIrNwCVUB74/IcJu1jFjW5ajAb6asEECEnbJjTGyKcxp8i52upjQ2ZiDHqYrFAs2IP1AtiNouEr+ShRILGVfSaKhlmVPQoVg7KMNi6SCi1+MsMlb7qqaUQgHZv9cR0i4VVa4iujolHSOFs5C2eoXSKqM44tBHVbCImZxEfKEY9aNHKy/ywk5IcNADrfz1rDEj7up3suQ775WZpJ0bHYitG53uI6nxCKBQNIGBUfQmzTi/T1AJduhbWRqrNJIrJ1SBtuPZ0uECki7bwX6qgALPTF+ERaVSI3fBr2m5r4g==',
  'CommandID' => 'AccountBalance',
  'PartyA' => '601466',
  'IdentifierType' => '4',
  'Remarks' => 'Nice man',
  'QueueTimeOutURL' => 'https://amisend.ngrok.io/daraja/',
  'ResultURL' => 'https://amisend.ngrok.io/daraja/'
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;



/*

Account Balance Response

{
    "Result": {
        "ResultType": 0,
        "ResultCode": 0,
        "ResultDesc": "The service request is processed successfully.",
        "OriginatorConversationID": "10106-1121464-1",
        "ConversationID": "AG_20180828_00004b46523e49956aa8",
        "TransactionID": "MHS0000000",
        "ResultParameters": {
            "ResultParameter": [
                {
                    "Key": "AccountBalance",
                    "Value": "Working Account|KES|453845.00|453845.00|0.00|0.00&Float Account|KES|0.00|0.00|0.00|0.00&Utility Account|KES|65602.00|65602.00|0.00|0.00&Charges Paid Account|KES|-660.00|-660.00|0.00|0.00&Organization Settlement Account|KES|0.00|0.00|0.00|0.00"
                },
                {
                    "Key": "BOCompletedTime",
                    "Value": 20180828202456
                }
            ]
        },
        "ReferenceData": {
            "ReferenceItem": {
                "Key": "QueueTimeoutURL",
                "Value": "https://internalsandbox.safaricom.co.ke/mpesa/abresults/v1/submit"
            }
        }
    }
}

*/
?>