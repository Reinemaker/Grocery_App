<?php

namespace app\models;

class Cart extends \app\core\Model
{
    public $cart_id;
    public $account_id;

    public function __construct()
    {
        parent::__construct();
    }

    public function getFromCartId($cart_id) {
        $SQL = "SELECT * FROM cart WHERE cart_id = :cart_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['cart_id' => $cart_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Cart');
        return $STMT->fetch();
    }

    public function get($account_id) {
        $SQL = "SELECT * FROM cart WHERE account_id = :account_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $account_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Cart');
        return $STMT->fetch();
    }

    public function addToCart($product_id, $quantity) {
        $productFromShoppingCart = $this->getProductFromShoppingCart($product_id);
        if ($productFromShoppingCart == true) {
            $SQL = "UPDATE shopping_cart SET quantity = :quantity WHERE product_id = :product_id AND cart_id = :cart_id";
        } else if ($productFromShoppingCart == true && $quantity == 0) {
            $SQL = "DELETE FROM shopping_cart WHERE product_id = :product_id AND cart_id = :cart_id";
        } else {
            $SQL = "INSERT INTO shopping_cart (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)";
        }
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['cart_id' => $this->cart_id, 'product_id' => $product_id, 'quantity' => $quantity]);
    }

    public function getProductFromShoppingCart($product_id) {
        $SQL = "SELECT * FROM shopping_cart WHERE product_id = :product_id AND cart_id = :cart_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['product_id' => $product_id, 'cart_id' => $this->cart_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\ShoppingCart');
        return $STMT->fetch();
    }

    public function getCartItems() {
        $SQL = "SELECT * FROM shopping_cart WHERE cart_id = :cart_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['cart_id' => $this->cart_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\ShoppingCart');
        return $STMT->fetchAll();
    }
}
