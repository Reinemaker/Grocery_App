<?php

namespace app\controllers;

use Exception;

class Auth extends \app\core\Controller
{


    public function post($data) {
        if (isset($data['action'])) {
            if ($data['action'] == "register") {
                $account = new \app\models\Account();
                $account->first_name = $data['first_name'];
                $account->last_name = $data['last_name'];
                $account->username = $data['username'];
                $account->password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
                $account->address = $data['address'];
                $account->is_employee = $data['is_employee'];
                $accountInDB = $account->get($data['username']);
                if (isset($accountInDB)) {
                    throw new Exception("Username already exists");
                }
                $account->insert();
                return $account;
            } else if ($data['action'] == "login") {
                $account = new \app\models\Account();
                $accountInDB = $account->get($data['username']);
                if ($accountInDB == false) {
                    return "Username does not exist";
                }
                if (password_verify($data['password'], $accountInDB->password_hash)){
                    $jwt = new \app\helpers\JWTHelper();
                    return $jwt->generateJWT($accountInDB);
                }

            } else {
                echo "Unknown action";
            }
        }
    }

    public function get(){
        echo "here";
    }
}
