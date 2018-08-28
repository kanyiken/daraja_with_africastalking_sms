<?php
$url = 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'Initiator' => ' ',
  'SecurityCredential' => ' ',
  'CommandID' => 'TransactionStatusQuery',
  'TransactionID' => ' ',
  'PartyA' => ' ',
  'IdentifierType' => '1',
  'ResultURL' => 'https://ip_address:port/result_url',
  'QueueTimeOutURL' => 'https://ip_address:port/timeout_url',
  'Remarks' => ' ',
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
