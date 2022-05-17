<?php

namespace app\models;

class Transaction extends \app\core\Model
{
    public $transaction_id;
    public $cart_id;
    public $payment_method;
    public $total;
    
    public function insert(){
        $SQL = "INSERT INTO transaction(transaction_id,cart_id,payment_method,total) VALUES (:transaction_id,:cart_id,:payment_method,:total)";
        $STMT = self::$_connection->prepare($SQL);
        var_dump($this);
        $STMT->execute(['transaction_id' => $this->transaction_id, 'cart_id'=>$this->cart_id,'payment_method'=>$this->payment_method,'total'=>$this->total]);
    }

    public function get($transaction_id) {
        $SQL = "SELECT * FROM transaction WHERE transaction_id = :transaction_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['transaction_id' => $transaction_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Transaction');
        return $STMT->fetch();
    }

    // get account from cart id using join
    public function getAccountFromCartId($cart_id) {
        $SQL = "SELECT * FROM account a JOIN cart c ON a.account_id = c.account_id WHERE c.cart_id = :cart_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['cart_id' => $cart_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Account');
        return $STMT->fetch();
    }


    public function getAllTransactionsFromCartId($cart_id) {
        $SQL = "SELECT * FROM transaction WHERE cart_id = :cart_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['cart_id' => $cart_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Transaction');
        return $STMT->fetchAll();
    }
}
