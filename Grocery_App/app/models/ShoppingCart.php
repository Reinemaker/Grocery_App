<?php

namespace app\models;

class ShoppingCart extends \App\core\Model{

    public $cart_id;
	public $product_id;
    public $shopping_cart_id;
	public $quantity;

    public function __construct() {
		parent::__construct();
	}

    public function clearShoppingCart($cart_id) {
		$SQL = 'DELETE FROM shopping_cart WHERE cart_id = :cart_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['cart_id'=>$cart_id]);
    }

}
//WIP