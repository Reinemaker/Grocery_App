<?php

namespace app\helpers;
use \Firebase\JWT\Key;
use \Firebase\JWT\JWT;

use DateTime;

class JWTHelper
{
    public function generateJWT($account){
        $key = "example_key";
        $iat = time();
        $payload = array(
            "account" => json_encode($account),
            "iss" => "http://localhost/",
            "aud" => "http://localhost/",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "exp" => $iat + 60 * 60 * 1,
            "iat" => $iat
        );
        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }
    
    public function decodeJWT($jwt){
        $key = "example_key";
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        return $decoded;
    }

}