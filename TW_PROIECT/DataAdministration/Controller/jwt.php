<?php

class JWT
{
    public static function get_token_from_header(){
        $headers = apache_request_headers();
        return explode(' ', $headers["Authorization"])[1];
    }

    /**
     * Encode the data into an JWT.
     * If field "live_time" is set the token will expire after "live_time" seconds, else
     * the "live_time" will be set as $DEFAULT_LIVE_TIME = 120.
     * @param $data
     * @return string
     */
    public static function encode($data){
        $DEFAULT_LIVE_TIME = 120;

        if (!isset($data["live_time"])){
            $data["live_time"] = $DEFAULT_LIVE_TIME;
        }

        $now = new DateTime();
        $data["live_time"] += $now->getTimestamp();

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
        return json_decode(base64_decode($token[1]), true);
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
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($text));
    }
}