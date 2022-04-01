<?php 
namespace app\controllers;

class HomeController extends \app\core\Controller {

    public function get($id=null){
        return $this->view("index", array("id" => $id));
    }
}