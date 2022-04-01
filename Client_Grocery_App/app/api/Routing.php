<?php

namespace app\api;


class Routing
{

    public $controller;
    //public $controllerMethod;
    public function __construct()
    {

        $keys = array_keys($_GET);
        if (count($keys) == 0){
            $home = new \app\controllers\HomeController();
            return $home->get();
        }
        $file_name = $keys[0] . 'Controller';
        if (file_exists(dirname(__DIR__) . '/controllers/' . $file_name . '.php')) {
            $classname = 'app\controllers\\'.$file_name;
            $file_exists = class_exists($classname);
            if ($file_exists) {
                $this->controller = new $classname;
                //$this->controllerMethod = $this->request->urlParams[$keys[0]];
                switch ( $_SERVER['REQUEST_METHOD']) {
                    case 'GET':
                        if (isset($_GET[$keys[0]])){
                            $this->get($_GET[$keys[0]]);
                            return;
                        }
                        $this->get();
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

    private function get($id = null){
       $this->controller->get($id);
    }

    private function post(){
        $response = $this->controller->post($this->request->payload);
        echo json_encode($response);
    }
}


