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
}
