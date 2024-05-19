<?php

class Authenticator
{
    /**
     * Generate a new secret key.
     *
     * @return string
     */
    public function generateSecretKey(): string
    {
        return base64_encode(random_bytes(32));
    }

    /**
     * Generate a QR code URL for the secret key.
     *
     * @param string $secretKey
     * @param string $issuer
     * @param string $userName
     * @return string
     */
    public function generateQRCodeUrl(string $secretKey, string $issuer, string $userName): string
    {
        $otpType = 'totp';
        $label = urlencode($issuer . ':' . $userName);
        $secret = urlencode(Base32::encode($secretKey));

        return "otpauth://$otpType/$label?secret=$secret&issuer=$issuer";
    }

    /**
     * Verify the provided OTP against the secret key.
     *
     * @param string $secretKey
     * @param string $otp
     * @param int $discrepancy
     * @return bool
     */
    public function verifyOtp(string $secretKey, string $otp, int $discrepancy = 1): bool
    {
        $currentTimeSlice = floor(time() / 30);

        for ($i = -$discrepancy; $i <= $discrepancy; $i++) {
            $timeSlice = $currentTimeSlice + $i;
            $expectedOtp = $this->generateOtp($secretKey, $timeSlice);

            if ($expectedOtp === $otp) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate an OTP for the given time slice.
     *
     * @param string $secretKey
     * @param int $timeSlice
     * @return string
     */
    private function generateOtp(string $secretKey, int $timeSlice): string
    {
        $secret = Base32::decode($secretKey);
        $time = pack('J', $timeSlice);

        $hash = hash_hmac('sha1', $time, $secret, true);

        $offset = ord($hash[19]) & 0xf;
        $code = (
            ((ord($hash[$offset + 0]) & 0x7f) << 24) |
            ((ord($hash[$offset + 1]) & 0xff) << 16) |
            ((ord($hash[$offset + 2]) & 0xff) << 8) |
            (ord($hash[$offset + 3]) & 0xff)
        ) % 1000000;

        return str_pad($code, 6, '0', STR_PAD_LEFT);
    }
}

/**
 * Base32 encoding/decoding class.
 */
class Base32
{
    private const ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

    /**
     * Encode data to Base32.
     *
     * @param string $data
     * @return string
     */
    public static function encode(string $data): string
    {
        $encoded = '';
        $dataLength = strlen($data);
        $i = 0;

        while ($i < $dataLength) {
            $byte0 = ord($data[$i++]);
            if ($i >= $dataLength) {
                $encoded .= self::ALPHABET[$byte0 >> 3];
                $encoded .= self::ALPHABET[($byte0 & 0x07) << 2];
                $encoded .= str_repeat('=', 6);
                break;
            }
            $byte1 = ord($data[$i++]);
            if ($i >= $dataLength) {
                $encoded .= self::ALPHABET[$byte0 >> 3];
                $encoded .= self::ALPHABET[(($byte0 & 0x07) << 2) | ($byte1 >> 6)];
                $encoded .= self::ALPHABET[($byte1 & 0x3f) >> 1];
                $encoded .= self::ALPHABET[($byte1 & 0x01) << 4];
                $encoded .= str_repeat('=', 4);
                break;
            }
            $byte2 = ord($data[$i++]);
            if ($i >= $dataLength) {
                $encoded .= self::ALPHABET[$byte0 >> 3];
                $encoded .= self::ALPHABET[(($byte0 & 0x07) << 2) | ($byte1 >> 6)];
                $encoded .= self::ALPHABET[($byte1 & 0x3f) >> 1];
                $encoded .= self::ALPHABET[(($byte1 & 0x01) << 4) | ($byte2 >> 4)];
                $encoded .= self::ALPHABET[($byte2 & 0x0f) << 1];
                $encoded .= '=';
                break;
            }
            $byte3 = ord($data[$i++]);
            $encoded .= self::ALPHABET[$byte0 >> 3];
            $encoded .= self::ALPHABET[(($byte0 & 0x07) << 2) | ($byte1 >> 6)];
            $encoded .= self::ALPHABET[($byte1 & 0x3f) >> 1];
            $encoded .= self::ALPHABET[(($byte1 & 0x01) << 4) | ($byte2 >> 4)];
            $encoded .= self::ALPHABET[($byte2 & 0x0f) << 1 | ($byte3 >> 7)];
            $encoded .= self::ALPHABET[($byte3 & 0x7f) >> 2];
            $encoded .= self::ALPHABET[($byte3 & 0x03) << 3];
        }

        return $encoded;
    }

    /**
     * Decode Base32 data.
     *
     * @param string $data
     * @return string
     */
    public static function decode(string $data): string
    {
        $data = strtoupper($data);
        $data = str_replace('=', '', $data);
        $dataLength = strlen($data);
        $decoded = '';

        for ($i = 0; $i < $dataLength; $i += 8) {
            $chunk = substr($data, $i, 8);
            $chunkLength = strlen($chunk);

            $decoded .= chr(
                (strpos(self::ALPHABET, $chunk[0]) << 3) |
                (strpos(self::ALPHABET, $chunk[1]) >> 2)
            );

            if ($chunkLength > 2) {
                $decoded .= chr(
                    ((strpos(self::ALPHABET, $chunk[1]) & 0x03) << 6) |
                    (strpos(self::ALPHABET, $chunk[2]) << 1) |
                    (strpos(self::ALPHABET, $chunk[3]) >> 4)
                );
            }

            if ($chunkLength > 4) {
                $decoded .= chr(
                    ((strpos(self::ALPHABET, $chunk[3]) & 0x0f) << 4) |
                    (strpos(self::ALPHABET, $chunk[4]) >> 1)
                );
            }

            if ($chunkLength > 5) {
                $decoded .= chr(
                    ((strpos(self::ALPHABET, $chunk[4]) & 0x01) << 7) |
                    (strpos(self::ALPHABET, $chunk[5]) << 2) |
                    (strpos(self::ALPHABET, $chunk[6]) >> 3)
                );
            }

            if ($chunkLength > 7) {
                $decoded .= chr(
                    ((strpos(self::ALPHABET, $chunk[6]) & 0x07) << 5) |
                    (strpos(self::ALPHABET, $chunk[7]))
                );
            }
        }

        return $decoded;
    }
}
?>