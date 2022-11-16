<?php

$num = 48239384;
$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';


$code = base64_encode($num);
$code1 = base64_decode($code);

echo $code;
echo '<br>';
echo $code1;
function encryptthis($data, $key)
{
    $encryption_key = base64_decode($key);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}
for ($i = 0; $i < 500; $i++) {
    $code = mt_rand(10000000, 99999999);
    $enc = encryptthis($code, $key);
}