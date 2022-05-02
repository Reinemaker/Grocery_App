<html>

<head>
    <title>Shopping Cart index</title>
</head>

<a href='<?= BASE ."/Main/secure" ?>'>Return to main menu</a>

<body>
    <span id="demo"> </span>
    <script>
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
    </script>

<?php 
            if (isset($data['carts'])) {
                foreach ($data['carts'] as $cart) {
                    echo "<h2>$product->name</h2>";
                    echo "<p>$product->type $</p>";
                    echo "<p>$product->quantity $</p>";
                    //picture 
                    echo "<img src='$product->picture_path' alt='$product->name' width='200' height='200'>";
                }
            }
        ?>

</body>
</html>