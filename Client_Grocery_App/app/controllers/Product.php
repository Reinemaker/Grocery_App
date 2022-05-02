<?php

namespace app\controllers;

// This client controller is an exapple of how to use controllers in client. Base yourselves on this.
class Product extends \app\core\Controller
{

	public function get($id = null)
	{
		return $this->view("index", array("id" => $id));
	}

	function productList()
	{
		$product = new \App\models\Product();
		$productList = $product->getAll();
		$this->view('Product/productList', ["products" => $productList]);
	}

	public function insert()
	{
		$product = new \App\models\Product();
		if (isset($_POST["action"])) {
			$product->name = $_POST["name"];
			$product->type = $_POST["type"];
			$product->quantity = $_POST["quantity"];
			$product->insert();
			header('location:' . BASE . '/Product/productListEmployee');
		} else
			$this->view("Product/insert", $product);
	}

	function delete($product_id)
	{
		$product = new \App\models\Product();
		$product = $product->get($product_id);
		$product->product_id = $product_id;
		$product->delete();
		header('location:' . BASE . '/Product/productListEmployee/');
	}

	function edit($product_id)
	{
		$product = new \App\models\Product();
		$product = $product->get($product_id);
		$product->product_id = $product_id;
		if (isset($_POST["action"])) {
			$product->name = $_POST["name"];
			$product->type = $_POST["type"];
			$product->quantity = $_POST["quantity"];
			$product->update();
			header("location:" . BASE . "/Product/productListEmployee");
		} else
			$this->view("Product/edit", $product);
	}


	public function search()
	{
		$product = new \App\models\Product();
		$search_results = $product->search($_GET['searchValue']);
		$this->view('Product/searchResults', ['search_results' => $search_results, 'search_word' => $_GET['searchValue']]);
	}

	public function sortSearch($search_word){
		$product = new \App\models\Product();
		$sorted_search_results = $product->sortSearch($search_word);
		$this->view('Product/searchResults', ['search_results' => $sorted_search_results]);
	}

	public function productDetails($product_id){
		$product = new \App\models\Product();
		$product = $product->get($product_id);
		$this->view('Product/productDetails', ['product' => $product]);

	}
}
