<html>
    <head>
        <title>home page</title>
    </head>

    <body>
        <h1>home page</h1>
        <p><a href='<?= BASE ?>/account/update'>Change the password</a></p>
        <?php include('C:\xampp\htdocs\Grocery_App\Client_Grocery_App\app\views\Product\search.php'); ?>
        <?php 
            if (isset($data['products'])) {
                foreach ($data['products'] as $product) {
                    echo "<h2>$product->name</h2>";
                    echo "<p>$product->price $</p>";
                    //picture 
                    echo "<img src='$product->picture_path' alt='$product->name' width='200' height='200'>";
                }
            }
        ?>
    </body>
</html>