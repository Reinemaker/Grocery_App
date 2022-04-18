<html>

<head>
    <title>Product index</title>
</head>

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

</body>

</html>