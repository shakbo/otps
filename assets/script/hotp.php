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
?>