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

    public static function decode($jwt, $secret_key)
    {
        list($header, $payload, $signature) = explode(".", $jwt);
        $expected_signature = base64_encode(hash_hmac("sha256", "$header.$payload", $secret_key, true));

        if ($signature === $expected_signature) {
            return json_decode(base64_decode($payload), true);
        } else {
            throw new Exception("Invalid JWT signature");
        }
    }
}



