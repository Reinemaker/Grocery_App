<?php

namespace app\controllers;

use Konekt\PdfInvoice\InvoicePrinter;

class Invoice {
        /**
     * @OA\Get(
     *     path="/api/Invoice/{invoice_id}",
     *     @OA\Response(response="200", description="Sends an email")
     * )
     */
    function get($invoice_id) {
        $logger = new \app\LoggerHelper();
        $logger = $logger->getLogger();
        $logger->debug("Generating invoice for invoice_id: " . $invoice_id);
        $transaction = new \app\models\Transaction();
        $transaction = $transaction->get($invoice_id);

        $transaction_history = new \app\models\TransactionHistory();
        $transaction_history = $transaction_history->get($invoice_id);

        $account = new \app\models\Transaction();
        $account = $account->getAccountFromCartId($transaction->cart_id);

        $invoice = new InvoicePrinter();
        
        /* Header settings */
        $invoice->setColor("#007fff");      // pdf color scheme
        $invoice->setType("Sale Invoice");    // Invoice Type
        $invoice->setReference($transaction->transaction_id);   // Reference
        $invoice->setDate(date('M dS ,Y', time()));   //Billing Date
        $invoice->setTime(date('h:i:s A', time()));   //Billing Time
        $invoice->setFrom(array("Vanier College", "Vanier College"));
        $invoice->setTo(array($account->first_name." ".$account->last_name));

        $product = new \app\models\Product();
        foreach ($transaction_history as $th) {
            $product = $product->get($th->product_id);
            $invoice->addItem($product->name, "", $th->quantity, 0, $product->price * $th->quantity, 0, $product->price * $th->quantity);
        }

        $invoice->addTotal("Total", $transaction->total);
        $invoice->addTotal("Total due", $transaction->total, true);

        $invoice->addBadge("Payment Paid");

        $invoice->addTitle("Important Notice");

        $invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you.");

        $invoice->setFooternote("My Company Name Here");

        $invoice->render('example1.pdf', 'I');
    }
}