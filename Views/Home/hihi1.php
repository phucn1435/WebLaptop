<?php 
function encryptVigenereBlocks($plaintext, $key) {
    $length = strlen($plaintext);
    $cipher = '';
    $lenK = strlen($key);

    for ($i = 0; $i < $length; $i += $lenK) {
        $block = substr($plaintext, $i, $lenK);
        
        // Check if the block contains only spaces
        if (ctype_space($block)) {
            $cipher .= $block;
        } else {
            $cipher .= encryptVigenere($block, $key);
        }
    }

    return $cipher;
}

// Hàm mã hóa Vigenere không thay đổi
function encryptVigenere($plaintext, $key) {
    $plaintextWithoutSpaces = str_replace(' ', '', $plaintext); // Remove spaces

    $length = strlen($plaintextWithoutSpaces);
    $cipher = '';
    $lenK = strlen($key);
    $spaceCount = 0; // Keep track of the spaces in the original plaintext

    for ($i = 0; $i < $length; $i++) {
        $char = $plaintextWithoutSpaces[$i];

        if ($char === ' ') {
            $spaceCount++;
        } else {
            $j = ($i - $spaceCount) % $lenK;
            $cipher .= chr(65 + (ord($char) - 65 + ord($key[$j]) - 65) % 26);
        }
    }

    return $cipher;
}

function decryptVigenereBlocks($ciphertext, $key) {
    $length = strlen($ciphertext);
    $plain = '';
    $lenK = strlen($key);

    for ($i = 0; $i < $length; $i += $lenK) {
        $block = substr($ciphertext, $i, $lenK);

        // Check if the block contains only spaces
        if (ctype_space($block)) {
            $plain .= $block;
        } else {
            $plain .= decryptVigenere($block, $key);
        }
    }

    return $plain;
}

// Hàm giải mã Vigenere không thay đổi
function decryptVigenere($ciphertext, $key) {
    $length = strlen($ciphertext);
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $j = $i % strlen($key);
        $diff = ord($ciphertext[$i]) - ord($key[$j]);
        if ($diff >= 0) {
            $result .= chr(65 + $diff % 26);
        } else {
            $result .= chr(65 + 26 + $diff % 26);
        }
    }

    return $result;
}


$plain = "THISCRYP TO SYSTEMISNOTSECURE";
$key = "CIPHER";

$cipher = encryptVigenereBlocks($plain, $key);
$decrypt = decryptVigenereBlocks($cipher, $key);
echo "Original: $plain\n";
echo "Encrypt: $cipher\n";
echo "Decrypt: $decrypt\n";


?>