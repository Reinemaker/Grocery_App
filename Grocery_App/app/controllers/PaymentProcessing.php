<?php

namespace app\controllers;

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;
use OpenApi\Annotations as OA;
use Konekt\PdfInvoice\InvoicePrinter;

class PaymentProcessing extends \app\core\Controller
{

    /**
     * @OA\Post(
     *     path="/api/PaymentProcessing/",
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="401", description="Unauthorized call to payment processing")
     * )
     */
    #[\app\filters\ValidateToken]
    function post($payload)
    {
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

    function get()
    {
        $invoice = new InvoicePrinter();
        
        /* Header settings */
        // $invoice->setLogo("images/sample1.jpg");   //logo image path
        $invoice->setColor("#007fff");      // pdf color scheme
        $invoice->setType("Sale Invoice");    // Invoice Type
        $invoice->setReference("INV-55033645");   // Reference
        $invoice->setDate(date('M dS ,Y', time()));   //Billing Date
        $invoice->setTime(date('h:i:s A', time()));   //Billing Time
        $invoice->setFrom(array("Seller Name", "Sample Company Name", "128 AA Juanita Ave", "Glendora , CA 91740"));
        $invoice->setTo(array("Purchaser Name", "Sample Company Name", "128 AA Juanita Ave", "Glendora , CA 91740"));

        $invoice->addItem("AMD Athlon X2DC-7450", "2.4GHz/1GB/160GB/SMP-DVD/VB", 6, 0, 580, 0, 3480);
        $invoice->addItem("PDC-E5300", "2.6GHz/1GB/320GB/SMP-DVD/FDD/VB", 4, 0, 645, 0, 2580);
        $invoice->addItem('LG 18.5" WLCD', "", 10, 0, 230, 0, 2300);
        $invoice->addItem("HP LaserJet 5200", "", 1, 0, 1100, 0, 1100);

        $invoice->addTotal("Total", 9460);
        $invoice->addTotal("VAT 21%", 1986.6);
        $invoice->addTotal("Total due", 11446.6, true);

        $invoice->addBadge("Payment Paid");

        $invoice->addTitle("Important Notice");

        $invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you.");

        $invoice->setFooternote("My Company Name Here");

        $invoice->render('example1.pdf', 'I');
    }
}
