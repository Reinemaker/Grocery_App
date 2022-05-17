<?php

namespace App\controllers;

class ShoppingCart extends \App\core\Controller
{
    public function index()
    {
        $cart = new \App\models\Cart();
        $account_id = json_decode($_SESSION['JWTDecoded']["account"])->account_id;
        $cart = $cart->get($account_id);
        $cart_items = $cart->getCartItems();
        $this->view("Payment/index");
    }

    public function addToCart()
    {
        $cart = new \App\models\Cart();
        $account_id = json_decode($_SESSION['JWTDecoded']["account"])->account_id;
        $cart = $cart->get($account_id);
        $cart->addToCart($_POST["product_id"], $_POST["quantity"]);
    }

    public function viewCart()
    {
        $cart = new \App\models\Cart();
        $account_id = json_decode($_SESSION['JWTDecoded']["account"])->account_id;
        $cart = $cart->get($account_id);
        $cart_items = $cart->getCartItems();
        $products = [];
        // getting the products from product ids 
        foreach ($cart_items as $cart_item) {
            $product = new \App\models\Product();
            $product = $product->get($cart_item->product_id);
            $products[] = ["product" => $product, "quantity" => $cart_item->quantity];
        }
        $this->view('ShoppingCart/index', ['cart_items' => $products, "cart_id" => $cart->cart_id]);
    }

    public function invoices() {
        $cart = new \App\models\Cart();
        $account_id = json_decode($_SESSION['JWTDecoded']["account"])->account_id;
        $cart = $cart->get($account_id);
        $transaction = new \app\models\Transaction();
        $transactions = $transaction->getAllTransactionsFromCartId($cart->cart_id);

        $this->view('Invoice/invoices', ['invoices' => $transactions]);
    }

    public function invoice($invoice_id) {
        $this->view('Invoice/invoice', ['invoice_id' => $invoice_id]);
    }
}
//WIP