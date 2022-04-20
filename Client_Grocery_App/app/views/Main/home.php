<html>
    <head>
        <title>home page</title>
    </head>

    <body>
        <h1>home page</h1>
        <?php 
            if (isset($data['products'])) {
                foreach ($data['products'] as $product) {
                    echo "<h2>$product->name</h2>";
                    echo "<p>$product->price</p>";
                    //picture 
                    echo "<img src='$product->picture_path' alt='$product->name' width='200' height='200'>";
                }
            }
        ?>
    </body>
</html>