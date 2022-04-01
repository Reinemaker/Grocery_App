<?php

namespace app\api;

use DateTime;

class JWTHelper
{
    public function generateJWT(){
        $key = "example_key";
        $iat = time();
        $payload = array(
            "iss" => "http://localhost/",
            "aud" => "http://localhost/",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "exp" => $iat + 60 * 60 * 1,
            "iat" => $iat
        );
        $jwt = \Firebase\JWT\JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }

    public function decodeJWT($jwt){
        $key = "example_key";
        $decoded = \Firebase\JWT\JWT::decode($jwt, $key, array('HS256'));
        return $decoded;
    }

}