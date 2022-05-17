<html>

<head>
    <title>Shopping Cart index</title>
    <link rel="stylesheet" href="/Grocery_App/Client_Grocery_App/app/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
    <div class="d-flex container" style="justify-content: space-between">
        <?php if (isset($data['cart_items'])) : ?>
            <div class="d-flex" style="flex-direction:column" style="width: 60%">
                <?php foreach ($data['cart_items'] as $cart_item) : ?>
                    <div class="d-flex" style="flex-direction:column">
                        <h1><?= $cart_item["product"]->name ?> </h1>
                        <h3 style="margin-left: 10px" id="total-<?= $cart_item['product']->product_id ?>"><?= $cart_item["product"]->price * $cart_item["quantity"] ?>$</h3>
                        <img style="width: 250px; height: 250px; margin-left: 10px" src="<?= $cart_item["product"]->picture_path ?>" alt="">
                    </div>

                    <div class="d-flex">
                        <button onclick="buttonAdd(<?= $cart_item['product']->product_id ?>)">+</button>
                        <span id="number-<?= $cart_item['product']->product_id ?>"><?= $cart_item["quantity"] ?></span>
                        <button onclick="buttonSubtract(<?= $cart_item['product']->product_id ?>)">-</button>
                        <button id="addToCart-<?= $cart_item['product']->product_id ?>" style="display: none" onclick="addToCart(<?= $cart_item['product']->product_id ?>)">Update Cart</button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="d-flex" style="flex-direction:column; width: 25%">

            <div class="box-2">
                <div class="box-inner-2">
                    <div>
                        <p class="fw-bold">Payment Details</p>
                        <p class="dis mb-3">Complete your purchase by providing your payment details</p>
                    </div>
                    <form action="">
                        <div class="mb-3">
                            <p class="dis fw-bold mb-2">Email address</p>
                            <input class="form-control" type="email" value="luke@skywalker.com">
                        </div>
                        <div>
                            <p class="dis fw-bold mb-2">Card details</p>
                            <div class="d-flex align-items-center justify-content-between card-atm border rounded">
                                <div class="fab fa-cc-visa ps-3"></div>
                                <input type="text" class="form-control" placeholder="Card Details">
                                <div class="d-flex w-50">
                                    <input type="text" class="form-control px-0" placeholder="MM/YY">
                                    <input type="password" maxlength=3 class="form-control px-0" placeholder="CVV">
                                </div>
                            </div>
                            <div class="my-3 cardname">
                                <p class="dis fw-bold mb-2">Cardholder name</p>
                                <input class="form-control" type="text">
                            </div>
                            <div class="address">
                                <p class="dis fw-bold mb-3">Billing address</p>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected hidden>United States</option>
                                    <option value="1">India</option>
                                    <option value="2">Australia</option>
                                    <option value="3">Canada</option>
                                </select>
                                <div class="d-flex">
                                    <input class="form-control zip" type="text" placeholder="ZIP">
                                    <input class="form-control state" type="text" placeholder="State">
                                </div>
                                <div class=" my-3">
                                    <p class="dis fw-bold mb-2">VAT Number</p>
                                    <div class="inputWithcheck">
                                        <input class="form-control" type="text" value="GB012345B9">
                                        <span class="fas fa-check"></span>

                                    </div>
                                </div>
                                <div class="d-flex flex-column dis">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p>Subtotal</p>
                                        <p><span class="fas fa-dollar-sign"></span>33.00</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p>VAT<span>(20%)</span></p>
                                        <p><span class="fas fa-dollar-sign"></span>2.80</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p class="fw-bold">Total</p>
                                        <p class="fw-bold"><span class="fas fa-dollar-sign"></span>35.80</p>
                                    </div>
                                    <div class="btn btn-primary mt-2">Pay<span class="fas fa-dollar-sign px-1"></span>35.80
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            xhttp.setRequestHeader("Authorization", "<?=$_SESSION["JWTtoken"] ?>");
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

        function formOnSubmit() {
            var email = document.getElementById("email").value;
            var ccNumber = document.getElementById("ccNumber").value;
            var ccExp = document.getElementById("ccExp").value;
            var ccCvv = document.getElementById("ccCvv").value;
            var ccFullName = document.getElementById("ccFullName").value;
            // var zip = document.getElementById("zip").value;
            // var state = document.getElementById("state").value;
            var url = "http://localhost/Grocery_App/Grocery_App/app/api/PaymentProcessing/";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        showToast("Payment Successful");
                    } else if (this.status == 400) {
                        showToast(this.responseText);
                    }
                }
            };
            var payload = { cartItems: <?= json_encode($data["cart_items"]) ?>, total: "100", cartId: <?= $data['cart_id'] ?>, email: email, ccNumber: ccNumber, ccMonth: ccExp.split("/")[0], ccYear: ccExp.split("/")[1], ccCvv: ccCvv, ccFullName: ccFullName };
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-Type", "application/json");
            xhttp.setRequestHeader("Authorization", "<?=$_SESSION["JWTtoken"] ?>");
            xhttp.send(JSON.stringify(payload));
        }
    </script>
</body>

</html>