<?php
namespace App\controllers;

class ShoppingCart extends \App\core\Controller{

    function index() {
		$cart = new \App\models\Shopping_Cart();
        $info = $cart->getAllForClient($_SESSION['client_id']);
		$this->view('cart/cart', ["info" => $info]);
	}

    public function insert() {
        $cart = new \App\models\Shopping_Cart();
        if (isset($_POST["action"])) {
			$cart->client_id = $_SESSION["client_id"];
            $cart->product_id = $_SESSION["product_id"];
            $cart->name = $_POST["name"];
            $cart->type = $_POST["type"];
            $cart->quantity = $_POST["quantity"];
            $cart->insert();
			header('location:'.BASE.'/Product/productList');
        } else 
            $this->view("cart/insert", $cart);
    }

    function delete($product_id) {
		$cart = new \App\models\Shopping_Cart();
		$cart = $cart->get($product_id);
		$cart->product_id = $product_id;
		$cart->delete();
		header('location:'.BASE.'/cart/cart/');
	}

}
//WIP