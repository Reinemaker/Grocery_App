<?php

namespace app\api;

use app\helpers\JWTHelper;

// include('app/init.php');
require_once(dirname(__DIR__) . "\\api\\http\\Requestbuilder.php");
// include('../init.php');



class Api
{
    public $request;
    public $controller;
    //public $controllerMethod;
    public function __construct()
    {
        $logger = new \app\LoggerHelper();
        $logger = $logger->getLogger();
        $logger->debug("Test log");
        $Requestbuilder = new http\Requestbuilder();
        $this->request = $Requestbuilder->getRequest();
        if ($this->request == null) {
            echo "error, url improperly formatted";
            return;
        }
        // $jwt = new JWTHelper();
        // $decodedToken = $jwt->decodeJWT($this->request->header["Authorization"]);
        // if ($decodedToken['iss'] == "http://localhost/" && $decodedToken['aud'] == "http://localhost/") {
        //     if ($decodedToken['exp'] > time()) {
        //         http_response_code(401);
        //     }
        // }
        // $attribute = new \app\attributes\AuthorizeAttribute();
        // if ($attribute->execute() == false) {
        //     throw new \Exception("User unauthorized");
        // }

        $keys = array_keys($this->request->urlParams);
        $file_name = $keys[0];
        if (file_exists(dirname(__DIR__) . '/controllers/' . $file_name . '.php')) {
            $classname = 'app\controllers\\' . $file_name;
            $file_exists = class_exists($classname);
            if ($file_exists) {
                $this->controller = new $classname;

                $reflection = new \ReflectionObject($this->controller);
                $controllerAttributes = $reflection->getAttributes();
                $methodAttributes = $reflection->getMethod($this->request->method)->getAttributes();
                
                $filters = array_values(array_filter(array_merge($controllerAttributes, $methodAttributes)));
                foreach($filters as $filter){
                    $filter = $filter->newInstance();
                    if($filter->execute())
                        return;
                }
                //$this->controllerMethod = $this->request->urlParams[$keys[0]];
                switch ($this->request->method) {
                    case 'GET':
                        $filter = null;
                        if (isset($keys[1])) {
                            $filter = $this->request->urlParams[$keys[1]];
                        }
                        $this->get($this->request->urlParams[$keys[0]], $filter);
                        break;
                    case 'POST':
                        $this->post();
                        break;
                    default:
                        echo "Method not allowed";
                        break;
                }
            }
        }
    }

    private function get($id, $filter)
    {
        if (isset($filter)) {
            $response = json_encode($this->controller->get($id, $filter));
        } else {
            $response = json_encode($this->controller->get($id));
        }
        echo $response;
    }

    private function post()
    {
        try {
            $response = $this->controller->post($this->request->payload);
            echo json_encode($response);
        } catch (\Exception $e) {
            echo $e->getMessage();
            http_response_code(400);
        }
    }
}
