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
    footer {
      background-color: #B1B3B4;
      padding: 10px;
      text-align: center;
      color: white;
      width: auto;
  }
  body{
    background-image: url("../pictures/bgWallpaper.png");
  }
  .container {
  display: grid;
  grid-template-columns: auto auto auto;
  background-color: #2196F3;
  padding: 10px;
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 20px;
  font-size: 30px;
  text-align: center;
}

</style>

<?php include('C:\xampp\htdocs\Grocery_App\Client_Grocery_App\app\views\Main\navbar.php'); ?>
</head>

<body>


    <!--<?php include('C:\xampp\htdocs\Grocery_App\Client_Grocery_App\app\views\Product\search.php'); ?>
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
?>-->

<div class="container">
      <div class="grid-item">Item 1</div>
      <div class="grid-item">Item 2</div>
      <div class="grid-item">Item 3</div>  
      <div class="grid-item">Item 4</div>
      <div class="grid-item">Item 5</div>
      <div class="grid-item">Item 6</div>  
      <div class="grid-item">Item 7</div>
      <div class="grid-item">Item 8</div>
      <div class="grid-item">Item 9</div>  
  </div>

</div>
</body>
<footer>
    <h1>Shopping App Inc.</h1>
</footer>

</html>