<?php
function randomnumberotp($digits = 6) {
    $padding = str_pad("", $digits, "0", STR_PAD_LEFT);
    return sprintf("%'{$padding}d", mt_rand(0, pow(10, $digits) - 1));
}
?>