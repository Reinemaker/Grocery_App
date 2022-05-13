<html>

<head>

</head>

<body>
    <?php include('C:\xampp\htdocs\Grocery_App\Client_Grocery_App\app\views\Main\navbar.php'); ?>
    <div>
        <h1>Invoice for order #</h1>
        <embed width=100 height=100 style="width: 100%; height: 100%;" src="http://localhost/Grocery_App/Grocery_App/app/api/PaymentProcessing/<?= $data["invoice_id"] ?>" type="application/pdf">
    </div>
</body>

</html>