<?php

class JWT
{
    public static function get_token_from_header(){
        $headers = apache_request_headers();
        return explode(' ', $headers["Authorization"])[1];
    }

    public static function encode($data){
        $DEFAULT_LIVE_TIME = 120;

        if (!isset($data["live_time"])){
            $now = new DateTime();
            $data["live_time"] = $now->getTimestamp() + $DEFAULT_LIVE_TIME;
        }

        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);

        $data = json_encode($data);

        $base64header = JWT::base64UrlEncode($header);
        $base64data = JWT::base64UrlEncode($data);

        $signature = hash_hmac('sha256', $base64header . "." . $base64data, SECRET, true);
        $base64signature = JWT::base64UrlEncode($signature);

        return $base64header . "." . $base64data . "." . $base64signature;
    }

    public static function decode($jwt){
        $token = explode('.', $jwt);
        return base64_decode($token[1]);
    }

    public static function validate($jwt){
        $token = explode('.', $jwt);
        $header = base64_decode($token[0]);
        $data = base64_decode($token[1]);
        $signatureProvided = $token[2];
        $base64header = JWT::base64UrlEncode($header);
        $base64data = JWT::base64UrlEncode($data);

        $signature = hash_hmac('sha256', $base64header . "." . $base64data, SECRET, true);
        $base64signature = self::base64UrlEncode($signature);

        if ($base64signature !== $signatureProvided){
            return "Invalid token.";
        }

        $now = new DateTime();
        $data = json_decode($data, true);
        if ($data["live_time"] < $now->getTimestamp()){
            return "Token has expired.";
        }

        return "OK";
    }

    private static function base64UrlEncode($text)
    {
        return base64_encode($text);
//        return str_replace(
//            ['+', '/', '='],
//            ['-', '_', ''],
//            base64_encode($text)
//        );
    }
}