<?php
$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ev1ikoWGDT7lUrVbG8NH9iJDQ8wo')); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'BusinessShortCode' => '174379',
  'Password' => 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919',
  'Timestamp' => '20180828210523',
  'TransactionType' => 'CustomerPayBillOnline',
  'Amount' => '200',
  'PartyA' => '174379',
  'PartyB' => '174379',
  'PhoneNumber' => '254790807760',
  'CallBackURL' => 'https://amisend.ngrok.io/daraja/',
  'AccountReference' => '',
  'TransactionDesc' => 'Check me'
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;
?>