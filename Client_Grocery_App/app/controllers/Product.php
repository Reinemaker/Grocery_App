<?php 
namespace app\controllers;

// This client controller is an exapple of how to use controllers in client. Base yourselves on this.
class Product extends \app\core\Controller {

    function index() {
		$product = new \App\models\Product();
        $productList = $product->getAll();
		$this->view('Product/productList', ["products" => $productList]);
	}

    /*public function insert() {
        $product = new \App\models\Product();
        if (isset($_POST["action"])) {
            $product->name = $_POST["name"];
            $product->type = $_POST["type"];
            $product->quantity = $_POST["quantity"];
            $product->insert();
			header('location:'.BASE.'/Product/productListEmployee');
        } else 
            $this->view("Product/insert", $product);

    }

    function delete($product_id) {
		$product = new \App\models\Product();
		$product = $product->get($product_id);
		$product->product_id = $product_id;
		$product->delete();
		header('location:'.BASE.'/Product/productListEmployee/');
	}

	function edit($product_id) {
		$product = new \App\models\Product();
        $product = $product->get($product_id);
		$product->product_id = $product_id;
		if(isset($_POST["action"])){
			$product->name = $_POST["name"];
			$product->type = $_POST["type"];
			$product->quantity = $_POST["quantity"];
			$product->update();
			header("location:".BASE."/Product/productListEmployee");
		}else
			$this->view("Product/edit", $product);
	}*/
}