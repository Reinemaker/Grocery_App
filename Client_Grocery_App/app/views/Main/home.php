<html>

<head>
    <title>home page</title>
    <style>
        .product {
            width: 300px;
        }
        .product:hover {
            background: lightgray;
        }
    </style>

    <?php include('C:\xampp\htdocs\Grocery_App\Client_Grocery_App\app\views\Main\navbar.php'); ?>
</head>

<body>
    

    <?php include('C:\xampp\htdocs\Grocery_App\Client_Grocery_App\app\views\Product\search.php'); ?>
    <?php
    $baseUrl = BASE . "/Product/productDetails";
    if (isset($data['products'])) {
        foreach ($data['products'] as $product) {
            echo "<div class='product'>";
            echo "<a href='$baseUrl/$product->product_id'><h2>$product->name</h2></a>";
            echo "<p>$product->price $</p>";
            //picture 
            echo "<a href='$baseUrl/$product->product_id'><img src='$product->picture_path' alt='$product->name' width='200' height='200'></a>";
            echo "</div>";
        }
    }
    ?>
</body>

</html>