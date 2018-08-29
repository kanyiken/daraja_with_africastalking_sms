<?php
$url = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ev1ikoWGDT7lUrVbG8NH9iJDQ8wo')); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'Initiator' => 'apitest466',
  'SecurityCredential' => 'G+bpsRnP077kFkQl2xH8qZeBSsqTR9ED9lt4VcwA1QIvpVcay03y4GNVcU0p6x25Ja4OLBb93MsD0QZW4+KC1qg/MfVPJ4sU1DDBtDkKXzK7KlaAlc9BQvZcl5UuMh3iO1+5b59YKWsB9XDs5I17c+WRbxcyg5fMBqGr5uF1AfBr9rKKsH/cssnFSm7CHQw9bwVgZ429itoDvm9/7ABbST+t+c7qY8MKDElR2RqTn+QjmlrwT0yswdmDItOb2pLsztuyVgoBhIyG0ANbDHloqxcYsHG4J/oyTaxex/swNx6m0KgG5iVKe6uLMsAnrTs8TLg0zHROqoycVbjgYv4hUg==',
  'CommandID' => 'TransactionReversal',
  'TransactionID' => 'MHS31H6FF9',
  'Amount' => '1000',
  'PartyA' => '601466',
  'ReceiverParty' => '600000',
  'RecieverIdentifierType' => '4',
  'ResultURL' => 'https://amisend.ngrok.io/daraja/',
  'QueueTimeOutURL' => 'https://amisend.ngrok.io/daraja/',
  'Remarks' => 'Test',
  'Occasion' => ' '
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;
?>