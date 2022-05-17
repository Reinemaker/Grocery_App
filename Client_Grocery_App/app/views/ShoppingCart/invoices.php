<html>

<head>
    <title>Invoices</title>
</head>

<body>
    <?php include('C:\xampp\htdocs\Grocery_App\Client_Grocery_App\app\views\Main\navbar.php'); ?>
    <div>
        <h1>Past transactions</h1>
        <?php foreach ($data['invoices'] as $invoice) { ?>
            <div>
                <h2>Invoice #<?= $invoice->transaction_id ?></h2>
                <a href="<?= BASE ?>ShoppingCart/invoice/<?= $invoice->transaction_id ?>">View Invoice</a>
            </div>
        <?php } ?>
    </div>
</body>

</html>