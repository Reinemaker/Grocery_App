<html>

<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="/Grocery_App/Client_Grocery_App/app/css/style.css">
</head>

<body>
    <div>
        <h1><?= $data['product']->name ?> </h1>
        <img src="<?= $data['product']->picture_path ?>" alt="">
    </div>

    <div>
        <button onclick="buttonAdd()">+</button>
        <span id="number">0</span>
        <button onclick="buttonSubtract()">-</button>
        <button id="addToCart" style="display: none" onclick="addToCart()">Add to Cart</button>

    </div>

    <div id="snackbar"></div>

    <script>
        function addToCart() {
            var number = document.getElementById("number").innerHTML;
            var product_id = <?= $data['product']->product_id ?>;
            var url = "<?= BASE ?>/Product/addToCart";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    showToast("Product added to cart");
                }
            };
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("product_id=" + product_id + "&quantity=" + number);
        }

        function buttonAdd() {
            var number = document.getElementById("number");
            var number_value = parseInt(number.textContent);
            if (number_value == 0) {
                document.getElementById("addToCart").style.display = "block";
            }
            number.innerHTML = number_value + 1;
        }

        function buttonSubtract() {
            var number = document.getElementById("number");
            var number_value = parseInt(number.textContent);
            if (number_value == 0) {
                return;
            }
            number.innerHTML = number_value - 1;
            if (number_value - 1 == 0) {
                document.getElementById("addToCart").style.display = "none";
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