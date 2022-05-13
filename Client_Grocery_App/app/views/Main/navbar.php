<style type="text/css">
nav {
    margin: 27px auto 0;

    position: relative;
    width: /*590px;*/805px;
    height: 50px;
    background-color: #B1B3B4;
    border-radius: 8px;
    font-size: 0;
}
nav a {
    line-height: 50px;
    height: 100%;
    font-size: 15px;
    display: inline-block;
    position: relative;
    z-index: 1;
    text-decoration: none;
    text-transform: uppercase;
    text-align: center;
    color: white;
    cursor: pointer;
}
nav .animation {
    position: absolute;
    height: 100%;
    top: 0;
    z-index: 0;
    transition: all .5s ease 0s;
    border-radius: 8px;
}
a:nth-child(1) {
    width: 100px;
}
a:nth-child(2) {
    width: 150px;
}
a:nth-child(3) {
    width: 125px;
}
a:nth-child(4) {
    width: 160px;
}
a:nth-child(5) {
    width: 150px;
}
a:nth-child(6) {
    width: 120px;
}
nav .start-home, a:nth-child(1):hover~.animation {
    width: 100px;
    left: 0;
    background-color: #1abc9c;
}
nav .start-about, a:nth-child(2):hover~.animation {
    width: 120px;
    left: 110px;
    background-color: #da9e8b;
}
nav .start-shopping, a:nth-child(3):hover~.animation {
    width: 150px;
    left: 235px;
    background-color: #3498db;
}
nav .start-transaction, a:nth-child(4):hover~.animation {
    width: 130px;
    left: 390px;
    background-color: #9b59b6;
}
nav .start-update, a:nth-child(5):hover~.animation {
    width: 160px;
    left: 530px;
    background-color: #e67e22;
}
nav .start-logout, a:nth-child(6):hover~.animation {
    width: 105px;
    left: 700px;
    background-color: #ff0001;
}

body {
    font-size: 12px;
    font-family: sans-serif;
}

.searchBar{
    display: flex;
}



</style>

<div>
    

</div>
    <nav>
        <a href='<?= BASE ?>Main/home'>Home</a>
        <a href='<?= BASE ?>Payment/index'>Payment</a>
        <a href='<?= BASE ?>ShoppingCart/index'>Shopping Cart</a>
        <a href='<?= BASE ?>Transaction/index'>Transaction</a>
        <a href='<?= BASE ?>Account/updateAccount'>Update Account</a>
        <a href='<?= BASE ?>Account/logout'>Logout</a>
        <div class="animation start-home"></div>
    </nav>

   
<div class="searchBar">
    
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

</div>





