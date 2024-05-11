<?php

class tokenHandler
{
    private static $secret_key;

    public static function setSecretKey($key)
    {
        self::$secret_key = $key;
    }

    /**
     * @throws \Random\RandomException
     */
    public function __construct() {
        // Nem szükséges itt generálni a titkos kulcsot
        // self::$secret_key = bin2hex(random_bytes(32));
    }

    public static function encode($payload): string
    {
        if (!self::$secret_key) {
            throw new Exception("Secret key is not set. Please set the secret key before encoding.");
        }

        $header = base64_encode(json_encode(array("alg" => "HS256", "typ" => "JWT")));
        $payload = base64_encode(json_encode($payload));
        $signature = base64_encode(hash_hmac("sha256", "$header.$payload", self::$secret_key, true));
        return "$header.$payload.$signature";
    }

    public static function decode($jwt)
    {
        if (!self::$secret_key) {
            throw new Exception("Secret key is not set. Please set the secret key before decoding.");
        }

        list($header, $payload, $signature) = explode(".", $jwt);
        $expected_signature = base64_encode(hash_hmac("sha256", "$header.$payload", self::$secret_key, true));
        if ($signature === $expected_signature) {
            return json_decode(base64_decode($payload), true);
        } else {
            throw new Exception("Invalid JWT signature");
        }
    }
}
