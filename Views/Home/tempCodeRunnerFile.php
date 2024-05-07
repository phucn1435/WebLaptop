<?php
function encryptVigenere($plaintext, $key) {
    $length = strlen($plaintext);
    $cipher = '';
    $lenK = strlen($key);

    for ($i = 0; $i < $length; $i++) {
        // Skip spaces in the plaintext
        if ($plaintext[$i] == ' ') {
            $cipher .= ' ';
            continue;
        }

        $j = $i % $lenK;
        $cipher .= chr(65 + (ord($plaintext[$i]) - 65 + ord($key[$j]) - 65) % 26);
    }

    return $cipher;
}

function decryptVigenere($ciphertext, $key) {
    $length = strlen($ciphertext);
    $plain = '';
    $lenK = strlen($key);

    for ($i = 0; $i < $length; $i++) {
        // Skip spaces in the ciphertext
        if ($ciphertext[$i] == ' ') {
            $plain .= ' ';
            continue;
        }

        $j = $i % $lenK;
        $diff = ord($ciphertext[$i]) - ord($key[$j]);
        if ($diff >= 0) {
            $plain .= chr(65 + $diff % 26);
        } else {
            $plain .= chr(65 + 26 + $diff % 26);
        }
    }

    return $plain;
}

$plain = "THIS CRYPTO SYSTEM IS NOT SECURE";
$key = "CIPHER";

echo "Encrypt: $plain => " . encryptVigenere($plain, $key) . "\n";

$cipher = encryptVigenere($plain, $key); // Store the cipher text

echo "Decrypt: $cipher <= " . decryptVigenere($cipher, $key) . "\n";

?>