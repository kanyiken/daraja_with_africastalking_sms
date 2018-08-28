<?php
$publicKey = file_get_contents('cert.cer');
$plaintext = "xkanyi1061@kK";

openssl_public_encrypt($plaintext, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

echo base64_encode($encrypted);

?>