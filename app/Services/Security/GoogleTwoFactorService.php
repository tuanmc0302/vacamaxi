<?php

namespace App\Services\Security;

class GoogleTwoFactorService
{
    public function generateSecret(int $length = 32): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = '';

        for ($index = 0; $index < $length; $index++) {
            $secret .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        }

        return $secret;
    }

    public function getOtpAuthUrl(string $issuer, string $accountName, string $secret): string
    {
        $label = rawurlencode($issuer.':'.$accountName);

        return sprintf(
            'otpauth://totp/%s?secret=%s&issuer=%s&algorithm=SHA1&digits=6&period=30',
            $label,
            $secret,
            rawurlencode($issuer),
        );
    }

    public function verifyCode(string $secret, string $code, int $window = 1): bool
    {
        $normalizedCode = preg_replace('/\s+/', '', $code);

        if (! preg_match('/^\d{6}$/', (string) $normalizedCode)) {
            return false;
        }

        $timestamp = (int) floor(time() / 30);

        for ($offset = -$window; $offset <= $window; $offset++) {
            if (hash_equals($this->generateCode($secret, $timestamp + $offset), (string) $normalizedCode)) {
                return true;
            }
        }

        return false;
    }

    private function generateCode(string $secret, int $timestamp): string
    {
        $secretKey = $this->base32Decode($secret);
        $binaryTime = pack('N*', 0).pack('N*', $timestamp);
        $hash = hash_hmac('sha1', $binaryTime, $secretKey, true);
        $offset = ord(substr($hash, -1)) & 0x0F;
        $segment = substr($hash, $offset, 4);
        $value = unpack('N', $segment)[1] & 0x7FFFFFFF;

        return str_pad((string) ($value % 1000000), 6, '0', STR_PAD_LEFT);
    }

    private function base32Decode(string $secret): string
    {
        $alphabet = array_flip(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ234567'));
        $secret = strtoupper($secret);
        $buffer = 0;
        $bitsLeft = 0;
        $result = '';

        foreach (str_split($secret) as $character) {
            if (! isset($alphabet[$character])) {
                continue;
            }

            $buffer = ($buffer << 5) | $alphabet[$character];
            $bitsLeft += 5;

            if ($bitsLeft >= 8) {
                $bitsLeft -= 8;
                $result .= chr(($buffer >> $bitsLeft) & 0xFF);
            }
        }

        return $result;
    }
}
