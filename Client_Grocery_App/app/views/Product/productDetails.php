<html>

<head>
    <title>Product Details</title>
</head>

<body>
    <div>
        <h1><?= $data['product']->name ?> </h1>
        <img src="<?= $data['product']->picture_path ?>" alt="">
    </div>

    <div>
        <button>+</button>
        <span id="number">0</span>
        <button>-</button>

    </div>

    <script>
        function addToCart() {
            var number = document.getElementById("number").innerHTML;
            var product_id = <?= $data['product']->product_id ?>;
            var url = "<?= BASE ?>/Product/addToCart";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("PUT", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("product_id=" + product_id + "&number=" + number);
        }
    </script>
</body>



</html>