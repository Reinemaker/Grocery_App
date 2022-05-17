<?php

namespace app\controllers;

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;
use OpenApi\Annotations as OA;

class PaymentProcessing extends \app\core\Controller
{

    /**
     * @OA\Post(
     *     path="/api/PaymentProcessing/",
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="401", description="Unauthorized call to payment processing")
     * )
     */
    // #[\app\filters\ValidateToken]
    function post($payload)
    {
        $logger = new \app\LoggerHelper();
        $logger = $logger->getLogger();
        $logger->debug("Processing payment");
        $formData = [
            'number' => $payload['ccNumber'],
            'expiryMonth' => $payload['ccMonth'],
            'expiryYear' => $payload['ccYear'],
            'cvv' => $payload['ccCvv'],
        ];

        $gateway = Omnipay::create('Dummy');

        $response = $gateway->purchase(
            [
                'amount' => 10,
                'currency' => 'CAD',
                'card' => $formData
            ]
        )->send();


        // Process response
        if ($response->isSuccessful()) {
            $logger->debug("Payment processed successfully, updating database");
            $transaction = new \app\models\Transaction();
            $transaction->transaction_id = $response->getTransactionReference();
            $transaction->cart_id = $payload["cartId"];
            $transaction->payment_method = "Credit Card";
            $transaction->total = $payload["total"];
            $transaction->insert();


            foreach ($payload["cartItems"] as $product) { 
                $transaction_history = new \app\models\TransactionHistory();
                $transaction_history->transaction_id = $transaction->transaction_id;
                $transaction_history->product_id = $product["product"]["product_id"];
                $transaction_history->quantity = $product["quantity"];
                $transaction_history->insert();
            }

            $shopping_cart = new \app\models\ShoppingCart();
            $shopping_cart->clearShoppingCart($payload["cartId"]);
            // Payment was successful
            print_r($response);
        } elseif ($response->isRedirect()) {

            // Redirect to offsite payment gateway
            $response->redirect();
        } else {
            $logger->error($response->getMessage());
            // Payment failed
            echo $response->getMessage();
        }
    }
}
