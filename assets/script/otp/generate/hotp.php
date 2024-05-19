<?php
function hmac($key, $message, $hash, $blockSize) {
    $block_sized_key = computeBlockSizedKey($key, $hash, $blockSize);
    $o_key_pad = $block_sized_key ^ str_repeat(chr(0x5c), $blockSize);
    $i_key_pad = $block_sized_key ^ str_repeat(chr(0x36), $blockSize);
    return $hash($o_key_pad . $hash($i_key_pad . $message));
}

function computeBlockSizedKey($key, $hash, $blockSize) {
    if (strlen($key) > $blockSize) {
        $key = $hash($key);
    }
    if (strlen($key) < $blockSize) {
        return str_pad($key, $blockSize, "\0");
    }
    return $key;
}

function hotp($key, $counter, $digits = 6, $hash = 'sha1') {
    $blockSize = 64;
    if ($hash === 'sha256') {
        $blockSize = 64; 
    } elseif ($hash === 'sha512') {
        $blockSize = 128;
    }

    $counter = pack('J*', $counter); 

    $hmac = hmac($key, $counter, $hash, $blockSize);

    $offset = ord($hmac[strlen($hmac) - 1]) & 0xf;
    $otp = (
        ((ord($hmac[$offset]) & 0x7f) << 24) |
        ((ord($hmac[$offset + 1]) & 0xff) << 16) |
        ((ord($hmac[$offset + 2]) & 0xff) << 8) |
        (ord($hmac[$offset + 3]) & 0xff)
    ) % pow(10, $digits);

    return str_pad($otp, $digits, '0', STR_PAD_LEFT);
}
?>