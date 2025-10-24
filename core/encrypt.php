<?php
function encrypt($data, $password) {
    $method = 'AES-256-CBC';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
    $key = hash('sha256', $password, true);
    $encrypted = openssl_encrypt($data, $method, $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function decrypt($data, $password) {
    $method = 'AES-256-CBC';
    $data = base64_decode($data);
    $iv_length = openssl_cipher_iv_length($method);
    $iv = substr($data, 0, $iv_length);
    $encrypted = substr($data, $iv_length);
    $key = hash('sha256', $password, true); 
    return openssl_decrypt($encrypted, $method, $key, 0, $iv);
}
?>
