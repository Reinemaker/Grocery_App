<html>
    <head>
        <title>home page</title>
    </head>

    <body>
        <h1>home page</h1>

<table>
	<tr><th>Name</th><th>Type</th><th>Quantity</th></tr>
<?php

foreach($data['products'] as $product && $data['departments'] as $deparent){

	echo "<tr>
			<td>$product->name</td>
			<td>$department->type</td>
            <td>$product->quantity</td>
			<td>
				<a href='" . BASE . "/Wishlist/insert/$product->product_id'>favorite</a>
			</td>
		</tr>";
}
?>
   
    </body>
</html>