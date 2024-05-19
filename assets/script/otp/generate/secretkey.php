<?php
function generateSecretKey(): string {
    // Generate 16 bytes of random data
    $randomBytes = random_bytes(20);

    // Convert the raw bytes to a Base32 encoded string
    return Base32Encoder::encode($randomBytes);
}

class Base32Encoder {
    private static $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

    public static function encode(string $data): string {
        $encoded = '';
        $padding = 0;
        $bits = 0;
        $index = 0;

        while (strlen($data) > 0) {
            $bits |= ord(substr($data, 0, 1)) << $index;
            $index += 8;
            $data = substr($data, 1);

            while ($index >= 5) {
                $encoded .= self::$alphabet[$bits >> ($index - 5)];
                $bits &= (1 << ($index - 5)) - 1;
                $index -= 5;
            }
        }

        if ($index > 0) {
            $encoded .= self::$alphabet[$bits << (5 - $index)];
            $padding = 8 - $index;
        }

        // Add padding characters if needed
        return str_pad($encoded, strlen($encoded) + $padding - (strlen($encoded) % 8), '=');
    }
}
?>