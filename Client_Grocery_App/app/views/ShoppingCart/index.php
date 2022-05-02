<html>

<head>
    <title>Shopping Cart index</title>
    <link rel="stylesheet" href="/Grocery_App/Client_Grocery_App/app/css/style.css">
</head>

<?php include('C:\xampp\htdocs\Grocery_App\Client_Grocery_App\app\views\Main\navbar.php'); ?>

<body>
    <span id="demo"> </span>
    <!-- <script>
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                document.getElementById("demo").innerHTML = xhttp.responseText;
            }
        };
        var url ="http://localhost/Assignment1_Web_Services_Natalie_Mulodjanov/Assignment1_WebServices/app/api/Client/<?php echo isset($data['id']) ? $data['id'] : '' ?>"

        xhttp.open(
            "GET",
            url,
            true
        );
        xhttp.send();
    </script> -->

    <?php if (isset($data['cart_items'])) : ?>
        <?php foreach ($data['cart_items'] as $cart_item) : ?>
            <?= var_dump($cart_item) ?>
            <div>
                <h1><?= $cart_item["product"]->name ?> </h1>
                <h3 id="total-<?=$cart_item['product']->product_id ?>"><?= $cart_item["product"]->price * $cart_item["quantity"] ?>$</h3>
                <img src="<?= $cart_item["product"]->picture_path ?>" alt="">
            </div>

            <div>
                <button onclick="buttonAdd(<?= $cart_item['product']->product_id ?>)">+</button>
                <span id="number-<?= $cart_item['product']->product_id ?>"><?= $cart_item["quantity"] ?></span>
                <button onclick="buttonSubtract(<?= $cart_item['product']->product_id ?>)">-</button>
                <button id="addToCart-<?= $cart_item['product']->product_id ?>" style="display: none" onclick="addToCart(<?= $cart_item['product']->product_id ?>)">Update Cart</button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <div id="snackbar"></div>

    <script>
        function addToCart(product_id) {
            var number = document.getElementById(`number-${product_id}`);
            var url = "<?= BASE ?>/Product/addToCart";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(`addToCart-${product_id}`).style.display = "none";
                    showToast("Cart has been updated");
                }
            };
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("product_id=" + product_id + "&quantity=" + number.textContent);
        }

        function buttonAdd(product_id) {
            var number = document.getElementById(`number-${product_id}`);
            var number_value = parseInt(number.textContent);
            document.getElementById(`addToCart-${product_id}`).style.display = "block";
            number.innerHTML = number_value + 1;
        }

        function buttonSubtract(product_id) {
            var number = document.getElementById(`number-${product_id}`);
            var number_value = parseInt(number.textContent);
            if (number_value == 0) {
                return;
            }
            number.innerHTML = number_value - 1;
            if (number_value - 1 == 0) {
                document.getElementById(`addToCart-${product_id}`).style.display = "none";
            }
        }

        function showToast(message) {
            var x = document.getElementById("snackbar");

            x.className = "show";
            x.textContent = message;

            // After 3 seconds, remove the show class from DIV
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    </script>
</body>

</html>