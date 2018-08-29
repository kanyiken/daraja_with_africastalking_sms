<?php
$url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ev1ikoWGDT7lUrVbG8NH9iJDQ8wo')); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'Initiator' => 'apitest466',
  'SecurityCredential' => 'G+bpsRnP077kFkQl2xH8qZeBSsqTR9ED9lt4VcwA1QIvpVcay03y4GNVcU0p6x25Ja4OLBb93MsD0QZW4+KC1qg/MfVPJ4sU1DDBtDkKXzK7KlaAlc9BQvZcl5UuMh3iO1+5b59YKWsB9XDs5I17c+WRbxcyg5fMBqGr5uF1AfBr9rKKsH/cssnFSm7CHQw9bwVgZ429itoDvm9/7ABbST+t+c7qY8MKDElR2RqTn+QjmlrwT0yswdmDItOb2pLsztuyVgoBhIyG0ANbDHloqxcYsHG4J/oyTaxex/swNx6m0KgG5iVKe6uLMsAnrTs8TLg0zHROqoycVbjgYv4hUg==',
  'CommandID' => 'BusinessPayBill',
  'SenderIdentifierType' => '4',
  'RecieverIdentifierType' => '4',
  'Amount' => '1000',
  'PartyA' => '601466',
  'PartyB' => '600000',
  'AccountReference' => '11111111',
  'Remarks' => 'Test',
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

B2B Response

{
    "Result": {
        "ResultType": 0,
        "ResultCode": 0,
        "ResultDesc": "The service request is processed successfully.",
        "OriginatorConversationID": "534-282114-1",
        "ConversationID": "AG_20180828_000066f55320aea46195",
        "TransactionID": "MHS41H6FF0",
        "ResultParameters": {
            "ResultParameter": [
                {
                    "Key": "InitiatorAccountCurrentBalance",
                    "Value": "{Amount={CurrencyCode=KES, MinimumAmount=45384500, BasicAmount=453845.00}}"
                },
                {
                    "Key": "DebitAccountCurrentBalance",
                    "Value": "{Amount={CurrencyCode=KES, MinimumAmount=45384500, BasicAmount=453845.00}}"
                },
                {
                    "Key": "Amount",
                    "Value": 1000
                },
                {
                    "Key": "DebitPartyAffectedAccountBalance",
                    "Value": "Working Account|KES|453845.00|453845.00|0.00|0.00"
                },
                {
                    "Key": "TransCompletedTime",
                    "Value": 20180828201622
                },
                {
                    "Key": "DebitPartyCharges"
                },
                {
                    "Key": "ReceiverPartyPublicName",
                    "Value": "600000 - saf test org"
                },
                {
                    "Key": "Currency",
                    "Value": "KES"
                }
            ]
        },
        "ReferenceData": {
            "ReferenceItem": [
                {
                    "Key": "BillReferenceNumber",
                    "Value": 11111111
                },
                {
                    "Key": "QueueTimeoutURL",
                    "Value": "https://internalsandbox.safaricom.co.ke/mpesa/b2bresults/v1/submit"
                },
                {
                    "Key": "Occassion"
                }
            ]
        }
    }
}

*/
?>

