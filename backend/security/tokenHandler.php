<?php

class tokenHandler
{
    public static function encode($payload, $secret_key): string
    {
        $header = base64_encode(json_encode(array("alg" => "HS256", "typ" => "JWT")));
        $payload = base64_encode(json_encode($payload));
        $signature = base64_encode(hash_hmac("sha256", "$header.$payload", $secret_key, true));
        return "$header.$payload.$signature";
    }
}