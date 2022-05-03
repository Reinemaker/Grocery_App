<?php

namespace app\controllers;

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

class PaymentProcessing extends \app\core\Controller
{
    function post($payload)
    {
        $formData = [
            'number' => '4242424242424242',
            'expiryMonth' => '6',
            'expiryYear' => '2026',
            'cvv' => '123'
        ];

        $gateway = Omnipay::create('Dummy');
        // $gateway->setApiKey('abc123');

        $response = $gateway->purchase(
            [
                'amount' => 10,
                'currency' => 'CAD',
                'card' => $formData
            ]
        )->send();

        // Process response
        if ($response->isSuccessful()) {

            // Payment was successful
            print_r($response);
        } elseif ($response->isRedirect()) {

            // Redirect to offsite payment gateway
            $response->redirect();
        } else {

            // Payment failed
            echo $response->getMessage();
        }
    }
}
