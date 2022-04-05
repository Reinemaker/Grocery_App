<?php 
namespace app\controllers;

// This client controller is an exapple of how to use controllers in client. Base yourselves on this.
class ShoppingController extends \app\core\Controller {

    public function get($id=null){
        return $this->view("index", array("id" => $id));
    }
}