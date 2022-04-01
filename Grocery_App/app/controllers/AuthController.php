<?php

namespace app\controllers;


class AuthController extends \app\core\Controller
{

    public function get($data)
    {
        echo "test";
        $jwt = new \app\api\JWTHelper();
        return $jwt->generateJWT();
    }
}
